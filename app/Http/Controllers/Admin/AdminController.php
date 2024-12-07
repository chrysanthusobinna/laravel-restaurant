<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
    public function index()
    {
        // Fake sales data for all months
        $salesData = [
            'January' => rand(100, 1000),
            'February' => rand(100, 1000),
            'March' => rand(100, 1000),
            'April' => rand(100, 1000),
            'May' => rand(100, 1000),
            'June' => rand(100, 1000),
            'July' => rand(100, 1000),
            'August' => rand(100, 1000),
            'September' => rand(100, 1000),
            'October' => rand(100, 1000),
            'November' => rand(100, 1000),
            'December' => rand(100, 1000),
        ];

        return view('admin.index', compact('salesData'));
    }

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
     
         $user = User::where('email', $request->email)->first();
     
         if ($user && Hash::check($request->password, $user->password)) {
             if ($user->status == 1) {
                 auth()->login($user);
                 return redirect()->route('admin.index');
             } else {
                 session(['user_email' => $user->email, 'user_name' => $user->name]);
     
                 if ($user->notice === "change_password_to_activate_account") {
                     return redirect()->route('admin.activate.account');
                 } elseif ($user->notice === "ban") {
                     return redirect()->route('admin.login')->withErrors(['account' => 'Your account has been banned. Please contact Support for assistance.']);
                 } else {
                     return redirect()->route('admin.login')->withErrors(['authentication' => 'Authentication error. Something occurred. Please try again.']);
                 }
             }
         } else {
             return back()->withErrors(['email' => 'Invalid email or password.']);
         }
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
    

    public function processApdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed', 
        ]);

        // Retrieve the user's email from the session
        $email = session('user_email');
        $user = User::where('email', $email)->first();

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


        // Redirect the user to the admin dashboard with a success message
        return redirect()->route('admin.index')->with('success', 'Your new password has been updated. You have been logged in successfully.');
    }


     // Handle logout
     public function logout()
     {
         Auth::logout();
         return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
     }
    
}
