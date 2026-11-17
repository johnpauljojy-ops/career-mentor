<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Feedback;

class GuestController extends Controller
{
    public function guesthome()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('adminhome')
                : redirect()->route('studenthome');
        }
        return view('guest.guesthome');
    }

    public function login()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('adminhome')
                : redirect()->route('studenthome');
        }
        return view('guest.login');
    }

    public function register()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('adminhome')
                : redirect()->route('studenthome');
        }
        return view('guest.register');
    }


    public function registerStore(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'username' => 'required|string|max:255|unique:users',
        'password' => 'required|string|min:6',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'role' => 'student',
        'status' => 'active',
    ]);

    // Safety check to ensure model instance is valid before login
    if ($user) {
        Auth::login($user);
    }

    return redirect()->intended('/studenthome')->with('success', 'Registration successful!');
}

public function loginStore(Request $request)
{
    $request->validate([
        'login' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    $credentials = [
        $fieldType => $request->login,
        'password' => $request->password,
    ];

    // Removed the remember parameter completely from Auth::attempt
    if ($attempt = Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->intended('/adminhome');
        } elseif ($user->role === 'student') {
            return redirect()->intended('/studenthome');
        }

        return redirect()->intended('/guesthome');
    }

    return back()->withErrors([
        'login' => 'The provided credentials do not match our records.',
    ])->onlyInput('login');
}

    public function feedbackStore(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $userId = Auth::check() ? (Auth::user()->userid ?? Auth::id()) : null;

        Feedback::create([
            'user_id' => $userId,
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status'  => 'unread',
        ]);

        return redirect(url()->previous() . '#feedback')
            ->with('feedback_success', 'Thank you! Your feedback has been sent to the mentoring administration.');
    }

}
