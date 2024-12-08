<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ActivationLinkEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ChangePasswordRequest;

class AuthController extends Controller
{
    
     // Show the login form
     public function showLoginForm()
     {
         return view('admin.login');
     }

     
     // Handle the login request
     public function login(Request $request)
     {
         $request->validate([
             'email' => 'required|email',
             'password' => 'required|string',
         ]);
     
         $user = user::where('email', $request->email)->first();
     
         if ($user && Hash::check($request->password, $user->password)) {
             if ($user->status == 1) {
                 auth()->login($user);
                 return redirect()->route('admin.index');
             } else {
                 session(['user_email' => $user->email, 'user_name' => $user->first_name]);
     
                 if ($user->notice === "change_password_to_activate_account") {
                     return redirect()->route('admin.activate.link.request');
                 } elseif ($user->notice === "banned") {
                     return redirect()->route('admin.login')->withErrors(['account' => 'Your account has been banned. Please contact Support for assistance.']);
                 } else {
                     return redirect()->route('admin.login')->withErrors(['authentication' => 'Authentication error. Something occurred. Please try again.']);
                 }
             }
         } else {
             return back()->withErrors(['email' => 'Invalid email or password.']);
         }
     }
     



    // Request Activation Link
     public function requestActivationLink(Request $request)
     {
        if (!session()->has('user_email') || !session()->has('user_name')) {
            return redirect()->route('admin.login')->withErrors(['error' => 'Something went wrong, please try to login again.']);
        }
        $email = session('user_email');
        $user = user::where('email', $email)->first();
       
 
         // Generate activation token
         $token = Str::random(60);
 
         // Save the token to the user (or separate table for better security)
         $user->activation_token = $token;
         $user->save();
 
         // Send activation link email
         Mail::to($user->email)->send(new ActivationLinkEmail($user, $token));
 
         return view('admin.activation-link-sent', ['email' => $user->email]);
     }

     
    // Account Activation 
    public function activateAccount()
    {
        if (!session()->has('user_email') || !session()->has('user_name')) {
            return redirect()->route('admin.login')->withErrors(['error' => 'Something went wrong, please try to login again.']);
        }
    
        //send  a verification code email to the user 

        $user_name = session('user_name');

        return view('admin.activate-account', compact('user_name'));
    }
    

    public function processApdatePassword(ChangePasswordRequest $request)
    {

        if (!session()->has('user_email') || !session()->has('user_name')) {
            return redirect()->route('admin.login')->withErrors(['error' => 'Something went wrong, please try to login again.']);
        }

        // Retrieve the user's email from the session
        $email = session('user_email');
        $user = user::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The provided old password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($request->password);
        $user->status = 1; // Activate account after password change
        $user->notice = null; // Clear any notices  
        $user->save();

        
        // Authenticate the user
        Auth::login($user);
        session()->forget(['user_email', 'user_name']);


        return redirect()->route('admin.index')->with('success', 'Your new password has been updated. You have been logged in successfully.');
    }

    public function showLinkRequestForm()
    {
        return view('admin.request-password');
    }

    // Handle sending the password reset email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    // Show the Reset Password form
    public function showResetForm(Request $request)
    {
        $token = $request->token;
        $email = $request->email;
        return view('admin.password-reset', compact('token', 'email'));
    }

    
    // Handle the password reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                Auth::login($user); // Automatically log in after reset
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('admin.index')->with('success', 'Your password has been reset successfully.')
            : back()->withErrors(['email' => [__($status)]]);
    }
 
}
