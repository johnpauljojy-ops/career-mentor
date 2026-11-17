<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Subscription_plans;
use App\Models\Subscription;
use App\Models\Student;
use App\Models\Payment;

class SubscriptionController extends Controller
{
    /**
     * Display the subscription plans page.
     */
    public function index()
    {
        $plans = Subscription_plans::where('is_active', true)->orderBy('price', 'asc')->get();

        $activeSubscription = null;
        $history = collect();
        $payments = collect();
        $student = null;

        if (Auth::check()) {
            $userId = Auth::id();
            $student = Student::where('userid', $userId)->first();

            // Auto-expire subscriptions that passed their end date
            Subscription::where('user_id', $userId)
                ->where('status', 'active')
                ->whereNotNull('end_date')
                ->where('end_date', '<', Carbon::now())
                ->update(['status' => 'expired']);

            // Fetch current active subscription
            $activeSubscription = Subscription::where('user_id', $userId)
                ->where('status', 'active')
                ->where('end_date', '>=', Carbon::now())
                ->with('plan')
                ->latest('id')
                ->first();

            // Fetch payment records from payments table
            $payments = Payment::where('user_id', $userId)
                ->with('plan')
                ->latest('id')
                ->get();

            // Fetch subscription history
            $history = Subscription::where('user_id', $userId)
                ->with('plan')
                ->latest('id')
                ->get();
        }

        return view('student.subcriptionplan', compact('plans', 'activeSubscription', 'history', 'payments', 'student'));
    }

    /**
     * Show dedicated payment page for a chosen plan.
     */
    public function payment($plan_id)
    {
        $plan = Subscription_plans::where('id', $plan_id)->where('is_active', true)->firstOrFail();
        $user = Auth::user();
        $student = Student::where('userid', $user->userid)->first();

        return view('student.payment', compact('plan', 'user', 'student'));
    }

    /**
     * Process payment and activate subscription using payments and subscriptions tables.
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'plan_id'        => 'required|exists:subscription_plans,id',
            'payment_method' => 'nullable|string|max:100',
        ]);

        $userId = Auth::id();
        $plan = Subscription_plans::findOrFail($request->plan_id);

        if (!$plan->is_active) {
            return redirect()->route('student.subscription')->with('error', 'This plan is currently not available.');
        }

        $paymentMethod = $request->payment_method ?? 'UPI / QR Code';

        // 1. Record transaction in payments table
        $payment = Payment::create([
            'user_id'        => $userId,
            'plan_id'        => $plan->id,
            'amount'         => $plan->price,
            'payment_method' => $paymentMethod,
            'payment_status' => 'completed',
            'paid_at'        => Carbon::now(),
        ]);

        // 2. Cancel prior active subscriptions for this user
        Subscription::where('user_id', $userId)
            ->where('status', 'active')
            ->update(['status' => 'cancelled']);

        // 3. Create active subscription record in subscriptions table
        $startDate = Carbon::now();
        $endDate = Carbon::now()->addDays($plan->duration_days);

        Subscription::create([
            'user_id'    => $userId,
            'plan_id'    => $plan->id,
            'start_date' => $startDate,
            'end_date'   => $endDate,
            'status'     => 'active',
        ]);

        return redirect()->route('student.resume.template1')
            ->with('success', '🎉 Payment of ₹' . number_format($plan->price, 2) . ' successful! Plan "' . $plan->plan_name . '" is now active until ' . $endDate->format('d M, Y') . '. Welcome to the Resume Builder!');
    }

    /**
     * Alias for processPayment
     */
    public function subscribe(Request $request)
    {
        return $this->processPayment($request);
    }

    /**
     * Cancel an active subscription.
     */
    public function cancel(Request $request, $id)
    {
        $userId = Auth::id();
        $subscription = Subscription::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $subscription->update(['status' => 'cancelled']);

        return redirect()->route('student.subscription')
            ->with('info', 'Your subscription to ' . ($subscription->plan->plan_name ?? 'the plan') . ' has been cancelled.');
    }
}
