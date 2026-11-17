<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qualification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Branches;
use App\Models\Subscription_plans;
use App\Models\ResumeTemplate;
use App\Models\Student;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Feedback;
use App\Models\StudentSkill;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function adminhome()
    {
        $totalStudents = Student::count();
        $totalUsers = User::where('role', 'student')->count() ?: User::count();
        $activeMembers = Subscription::where('status', 'active')
            ->whereNotNull('end_date')
            ->where('end_date', '>=', now())
            ->count();
        
        $totalRecommendations = StudentSkill::distinct()->count('studentid') ?: Student::whereNotNull('qualification_id')->count();
        $resumesBuilt = ResumeTemplate::where('status', 'active')->count() + DB::table('resumes')->count();
        
        $recentStudents = Student::with(['user', 'qualification', 'branch'])->latest('studentid')->take(5)->get();
        $recentPayments = Payment::with(['plan', 'user'])->latest('id')->take(6)->get();
        $recentFeedbacks = Feedback::latest('id')->take(5)->get();
        $totalFeedbacks = Feedback::count();
        $unreadFeedbacks = Feedback::where('status', 'unread')->count();

        return view('admin.adminhome', compact(
            'totalStudents',
            'totalUsers',
            'activeMembers',
            'totalRecommendations',
            'resumesBuilt',
            'recentStudents',
            'recentPayments',
            'recentFeedbacks',
            'totalFeedbacks',
            'unreadFeedbacks'
        ));
    }


    // Display the dashboard or qualification management view
public function qualificationsIndex()
    {
        $qualifications = Qualification::all();
        return view('admin.addqualification', compact('qualifications'));
    }

    public function qualificationsStore(Request $request)
    {
        $request->validate([
            'qualification_name' => 'required|string|max:255|unique:qualifications',
        ]);

        Qualification::create([
            'qualification_name' => $request->qualification_name,
        ]);

        return redirect()->route('admin.addqualification')->with('success', 'Qualification added successfully!');
    }

    public function qualificationsEdit($qualification_id)
    {
        $qualification = Qualification::findOrFail($qualification_id);
        $qualifications = Qualification::all();
        return view('admin.addqualification', compact('qualification', 'qualifications'));
    }

    public function qualificationsUpdate(Request $request, $qualification_id)
    {
        $request->validate([
            'qualification_name' => 'required|string|max:255|unique:qualifications,qualification_name,' . $qualification_id . ',qualification_id',
        ]);

        $qualification = Qualification::findOrFail($qualification_id);
        $qualification->update([
            'qualification_name' => $request->qualification_name,
        ]);

        return redirect()->route('admin.addqualification')->with('success', 'Qualification updated successfully!');
    }

    public function qualificationsDestroy($qualification_id)
    {
        $qualification = Qualification::findOrFail($qualification_id);
        $qualification->delete();

        return redirect()->route('admin.addqualification')->with('success', 'Qualification deleted successfully!');
    }




public function branchesIndex()
    {
        $branches = Branches::with('qualification')->get();
        $qualifications = Qualification::all();
        return view('admin.addbranch', compact('branches', 'qualifications'));
    }

    // Store a new branch
    public function branchesStore(Request $request)
    {
        $request->validate([
            'qualification_id' => 'required|exists:qualifications,qualification_id',
            'branch_name' => 'required|string|max:255',
        ]);

        Branches::create([
            'qualification_id' => $request->qualification_id,
            'branch_name' => $request->branch_name,
        ]);

        return redirect()->route('admin.branches.index')->with('success', 'Branch added successfully!');
    }

    // Show specific branch for editing
    public function branchesEdit($branch_id)
    {
        $branch = Branches::findOrFail($branch_id);
        $branches = Branches::with('qualification')->get();
        $qualifications = Qualification::all();
        return view('admin.addbranch', compact('branch', 'branches', 'qualifications'));
    }

    // Update an existing branch
    public function branchesUpdate(Request $request, $branch_id)
    {
        $request->validate([
            'qualification_id' => 'required|exists:qualifications,qualification_id',
            'branch_name' => 'required|string|max:255',
        ]);

        $branch = Branches::findOrFail($branch_id);
        $branch->update([
            'qualification_id' => $request->qualification_id,
            'branch_name' => $request->branch_name,
        ]);

        return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully!');
    }

    // Delete a branch
    public function branchesDestroy($branch_id)
    {
        $branch = Branches::findOrFail($branch_id);
        $branch->delete();

        return redirect()->route('admin.branches.index')->with('success', 'Branch deleted successfully!');
    }

    public function destroy(Request $request)
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect to the route that loads guest.blade.php
    return redirect('/'); // or return redirect()->route('guest');
} 


    // ---------- Subscription Plans ----------

public function plansIndex()
{
    $plans = Subscription_plans::latest()->get();
    return view('admin.addplan', compact('plans'));
}

public function plansStore(Request $request)
{
    $request->validate([
        'plan_name'     => 'required|string|max:255|unique:subscription_plans,plan_name',
        'price'         => 'required|numeric|min:0',
        'duration_days' => 'required|integer|min:1',
        'description'   => 'nullable|string',
    ]);

    Subscription_plans::create([
        'plan_name'     => $request->plan_name,
        'price'         => $request->price,
        'duration_days' => $request->duration_days,
        'description'   => $request->description,
        'is_active'     => $request->boolean('is_active'),
    ]);

    return redirect()->route('admin.addplan')->with('success', 'Plan added successfully!');
}

public function plansEdit($id)
{
    $plan  = Subscription_plans::findOrFail($id);
    $plans = Subscription_plans::latest()->get();
    return view('admin.addplan', compact('plan', 'plans'));
}

public function plansUpdate(Request $request, $id)
{
    $request->validate([
        'plan_name'     => 'required|string|max:255|unique:subscription_plans,plan_name,' . $id,
        'price'         => 'required|numeric|min:0',
        'duration_days' => 'required|integer|min:1',
        'description'   => 'nullable|string',
    ]);

    $plan = Subscription_plans::findOrFail($id);
    $plan->update([
        'plan_name'     => $request->plan_name,
        'price'         => $request->price,
        'duration_days' => $request->duration_days,
        'description'   => $request->description,
        'is_active'     => $request->boolean('is_active'),
    ]);

    return redirect()->route('admin.addplan')->with('success', 'Plan updated successfully!');
}

public function plansDestroy($id)
{
    Subscription_plans::findOrFail($id)->delete();

    return redirect()->route('admin.addplan')->with('success', 'Plan deleted successfully!');
}

public function plansActivate($id)
{
    $plan = Subscription_plans::findOrFail($id);
    $plan->update(['is_active' => true]);

    return redirect()->route('admin.addplan')->with('success', $plan->plan_name . ' activated.');
}

public function plansDeactivate($id)
{
    $plan = Subscription_plans::findOrFail($id);
    $plan->update(['is_active' => false]);

    return redirect()->route('admin.addplan')->with('success', $plan->plan_name . ' deactivated.');
}

    // ---------- Resume Templates ----------

    public function resumeTemplatesIndex()
    {
        $templates = ResumeTemplate::latest('id')->get();
        return view('admin.addresumetemplate', compact('templates'));
    }

    public function resumeTemplatesStore(Request $request)
    {
        $request->validate([
            'template_name' => 'required|string|max:255',
            'blade_file'    => 'required|string|max:255',
            'status'        => 'required|string|in:active,inactive',
            'preview_img'   => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('preview_img')) {
            $file = $request->file('preview_img');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/resume_templates'), $fileName);
            $imagePath = 'uploads/resume_templates/' . $fileName;
        }

        ResumeTemplate::create([
            'template_name' => $request->template_name,
            'blade_file'    => $request->blade_file,
            'status'        => $request->status,
            'preview_img'   => $imagePath,
        ]);

        return redirect()->route('admin.resumetemplates.index')->with('success', 'Resume template added successfully!');
    }

    public function resumeTemplatesEdit($id)
    {
        $template = ResumeTemplate::findOrFail($id);
        $templates = ResumeTemplate::latest('id')->get();
        return view('admin.addresumetemplate', compact('template', 'templates'));
    }

    public function resumeTemplatesUpdate(Request $request, $id)
    {
        $request->validate([
            'template_name' => 'required|string|max:255',
            'blade_file'    => 'required|string|max:255',
            'status'        => 'required|string|in:active,inactive',
            'preview_img'   => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $template = ResumeTemplate::findOrFail($id);
        $imagePath = $template->preview_img;

        if ($request->hasFile('preview_img')) {
            if ($imagePath && file_exists(public_path($imagePath)) && str_contains($imagePath, 'uploads/resume_templates')) {
                @unlink(public_path($imagePath));
            }
            $file = $request->file('preview_img');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/resume_templates'), $fileName);
            $imagePath = 'uploads/resume_templates/' . $fileName;
        }

        $template->update([
            'template_name' => $request->template_name,
            'blade_file'    => $request->blade_file,
            'status'        => $request->status,
            'preview_img'   => $imagePath,
        ]);

        return redirect()->route('admin.resumetemplates.index')->with('success', 'Resume template updated successfully!');
    }

    public function resumeTemplatesDestroy($id)
    {
        $template = ResumeTemplate::findOrFail($id);
        if ($template->preview_img && file_exists(public_path($template->preview_img)) && str_contains($template->preview_img, 'uploads/resume_templates')) {
            @unlink(public_path($template->preview_img));
        }
        $template->delete();

        return redirect()->route('admin.resumetemplates.index')->with('success', 'Resume template deleted successfully!');
    }

    public function resumeTemplatesActivate($id)
    {
        $template = ResumeTemplate::findOrFail($id);
        $template->update(['status' => 'active']);

        return redirect()->route('admin.resumetemplates.index')->with('success', $template->template_name . ' activated.');
    }

    public function resumeTemplatesDeactivate($id)
    {
        $template = ResumeTemplate::findOrFail($id);
        $template->update(['status' => 'inactive']);

        return redirect()->route('admin.resumetemplates.index')->with('success', $template->template_name . ' deactivated.');
    }

    // ---------- Reports & User Feedbacks ----------

    public function reportsIndex()
    {
        $feedbacks = Feedback::with('user')->latest('id')->paginate(10);
        $totalFeedbacks = Feedback::count();
        $unreadFeedbacks = Feedback::where('status', 'unread')->count();
        $totalStudents = Student::count();
        $activeMembers = Subscription::where('status', 'active')->where('end_date', '>=', now())->count();
        $totalRevenue = Payment::where('payment_status', 'completed')->sum('amount');
        $totalResumes = ResumeTemplate::where('status', 'active')->count();

        return view('admin.viewreports', compact(
            'feedbacks',
            'totalFeedbacks',
            'unreadFeedbacks',
            'totalStudents',
            'activeMembers',
            'totalRevenue',
            'totalResumes'
        ));
    }

    public function feedbackMarkRead($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->update(['status' => 'read']);

        return redirect()->back()->with('success', 'Feedback marked as read.');
    }

    public function feedbackDestroy($id)
    {
        Feedback::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Feedback deleted successfully.');
    }

    // ---------- Manage User Payments ----------

    public function paymentsIndex(Request $request)
    {
        $query = Payment::with(['user.student.qualification', 'user.student.branch', 'plan'])->latest('id');

        // Filter by status if provided
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('payment_status', $request->status);
        }

        // Search by user name, email, or plan
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($uq) use ($search) {
                    $uq->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('username', 'like', "%{$search}%");
                })->orWhereHas('plan', function ($pq) use ($search) {
                    $pq->where('plan_name', 'like', "%{$search}%");
                })->orWhere('id', 'like', "%{$search}%")
                  ->orWhere('payment_method', 'like', "%{$search}%");
            });
        }

        $payments = $query->paginate(12)->withQueryString();

        $totalRevenue = Payment::where('payment_status', 'completed')->sum('amount');
        $completedCount = Payment::where('payment_status', 'completed')->count();
        $pendingCount = Payment::where('payment_status', 'pending')->count();
        $totalTransactions = Payment::count();
        $activeSubscribers = Subscription::where('status', 'active')->where('end_date', '>=', now())->count();

        return view('admin.managepayments', compact(
            'payments',
            'totalRevenue',
            'completedCount',
            'pendingCount',
            'totalTransactions',
            'activeSubscribers'
        ));
    }

}
