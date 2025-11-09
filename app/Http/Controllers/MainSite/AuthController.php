<?php

namespace App\Http\Controllers\MainSite;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ActivationLinkEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Traits\CartTrait;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Controllers\Traits\OrderNumberGeneratorTrait;
use App\Http\Controllers\Traits\MainSiteViewSharedDataTrait;

class AuthController extends Controller
{
    
    use CartTrait;
    use MainSiteViewSharedDataTrait;
    use OrderNumberGeneratorTrait;


    public function __construct()
    {
        $this->shareMainSiteViewData();
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
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

            $dashboardRoute = $this->getDashboardRoute($user);
          

             if ($user->status == 1) {
                 auth()->login($user);
                 return redirect()->route($dashboardRoute);
             } else {
                 session(['user_email' => $user->email, 'user_name' => $user->first_name]);
     
                 if ($user->notice === "change_password_to_activate_account") {

                     return redirect()->route('auth.activate.link.request');

                 } elseif ($user->notice === "banned") {

                     $errorMessage = 'Your account has been banned. Please contact Support for assistance.';
                     return redirect()->route('auth.login')->withErrors(['account' => $errorMessage]);

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
            $errorMessage = 'Something went wrong, please try to login again.';
            return redirect()->route('auth.login')->withErrors(['error' => $errorMessage]);
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
 
         return view('auth.activation-link-sent', ['email' => $user->email]);
     }

     
    // Account Activation 
    public function activateAccount()
    {
        if (!session()->has('user_email') || !session()->has('user_name')) {
            $errorMessage = 'Something went wrong, please try to login again.';
            return redirect()->route('auth.login')->withErrors(['error' => $errorMessage]);
        }
    
        //send  a verification code email to the user 

        $user_name = session('user_name');

        return view('auth.activate-account', compact('user_name'));
    }
    

    public function processApdatePassword(ChangePasswordRequest $request)
    {

        if (!session()->has('user_email') || !session()->has('user_name')) {
            $errorMessage = 'Something went wrong, please try to login again.';
            return redirect()->route('auth.login')->withErrors(['error' => $errorMessage]);
        }

        // Retrieve the user's email from the session
        $email = session('user_email');
        $user = user::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        if (!Hash::check($request->old_password, $user->password)) {
            $errorMessage = 'The provided old password is incorrect.';
            return back()->withErrors(['old_password' => $errorMessage]);
        }

        // Update the password
        $user->password = Hash::make($request->password);
        $user->status = 1; // Activate account after password change
        $user->notice = null; // Clear any notices  
        $user->save();

        
        // Authenticate the user
        Auth::login($user);
        session()->forget(['user_email', 'user_name']);

        $dashboardRoute = $this->getDashboardRoute($user);

        $successMessage = 'Your new password has been updated. You have been logged in successfully.';
        return redirect()->route($dashboardRoute)->with('success', $successMessage);
    }

    public function showLinkRequestForm()
    {
        return view('auth.request-password');
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
        return view('auth.password-reset', compact('token', 'email'));
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

        $dashboardRoute = $this->getDashboardRoute(Auth::user());

        return $status === Password::PASSWORD_RESET
            ? redirect()->route($dashboardRoute)->with('success', 'Your password has been reset successfully.')
            : back()->withErrors(['email' => [__($status)]]);
    }

    private function getDashboardRoute(User $user): string
    {
        return in_array($user->role, ['admin', 'global_admin']) 
            ? 'admin.dashboard' 
            : 'home';
    }

      // Handle logout
     public function logout()
     {
         Auth::logout();
         return redirect()->route('auth.login')->with('success', 'Logged out successfully.');
     }
}
