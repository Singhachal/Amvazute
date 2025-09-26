<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{


public function store(Request $request)
{
    $validated = $request->validate([
        'name'              => 'required|string|max:255',
        'email'             => 'required|string|email|max:255|unique:users',
        'password'          => 'required|string|min:8|same:confirm_password',
        'confirm_password'  => 'required|string|min:8',
        'terms'             => 'accepted',
    ]);

    $user = User::create([
        'name'     => $validated['name'],
        'email'    => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    // Login after registration
    Auth::login($user);

    return response()->json([
        'status'  => 'success',
        'message' => 'Account created successfully!',
        'redirect' => route('home')
    ]);
}


 public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt(str()->random(16)),
                ]
            );

            Auth::login($user);

            return redirect('/')->with('success', 'Welcome, ' . $user->name);
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google login failed.');
        }
    }


   public function login(Request $request)
{
    // Validate input
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required|min:6',
    ]);

    // Check if email exists in DB
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors([
            'email' => 'No account found, please sign up first.',
        ])->withInput();
    }

    // Check if password matches
    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'password' => 'Incorrect password, please try again.',
        ])->withInput();
    }

    // Login the user
    Auth::login($user);
    $request->session()->regenerate();

    return redirect('/')
        ->with('success', 'Login successful!');
}


public function showForgetPasswordForm()
    {
        return view('front.auth.forget-password');
    }

    // Handle form submission
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['success' => 'We have emailed your password reset link!'])
                    : back()->withErrors(['email' => 'Unable to send reset link.']);
    }


    public function showResetPasswordForm($token)
    {
        return view('front.auth.reset-password', ['token' => $token]);
    }

    // Handle reset password
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('success', 'Password has been reset successfully!')
                    : back()->withErrors(['email' => [__($status)]]);
    }



}
