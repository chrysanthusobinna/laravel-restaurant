<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use App\Mail\PasswordChangedNotification;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Controllers\Traits\OrderStatisticsTrait;
use App\Http\Controllers\Traits\AdminViewSharedDataTrait;

class AdminController extends Controller
{
    use OrderStatisticsTrait;
    use AdminViewSharedDataTrait;


    public function __construct()
    {
        $this->shareAdminViewData();
        $this->shareOrderStatistics();
        
    }
    
    public function index()
    {
        $currentYear = now()->year;
    
        $salesData = \DB::table('orders')
            ->selectRaw('MONTHNAME(created_at) as month, COUNT(*) as total_sales')
            ->whereYear('created_at', $currentYear)  
            ->groupByRaw('MONTH(created_at), MONTHNAME(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->pluck('total_sales', 'month');
    
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June', 
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        $formattedSalesData = collect($months)->mapWithKeys(function ($month) use ($salesData) {
            return [$month => $salesData->get($month, 0)];
        });
    
        return view('admin.dashboard', compact('formattedSalesData'));
    }
    

    public function viewMyProfile()
    {
        $user = Auth::User();  
        return view('admin.view-my-profile', compact('user'));
    }


    public function editMyProfile()
    {
        $user = Auth::User();  
        return view('admin.edit-my-profile', compact('user'));
    }

    public function updateMyProfile(UpdateProfileRequest $request)
    {
        $user = Auth::User();
        $validated = $request->validated();
    
        $user->first_name = $validated['first_name'];
        $user->middle_name = $validated['middle_name']; // Optional, so it can be null
        $user->last_name = $validated['last_name'];        
        $user->email = $validated['email'];
        $user->phone_number = $validated['phone_number'];
        $user->address = $validated['address'];
    
        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_picture) {
                Storage::delete('profile-picture/' . $user->profile_picture);
            }
    
            // Store new profile photo
            $photoPath = $request->file('profile_photo')->store('profile-picture', 'public');
            $user->profile_picture = basename($photoPath);
        }
    
        // Save the updated user data
        $user->save();
    
        // Return success message
        return back()->with('success', 'Profile updated successfully.');
    }
    

    public function showChangePasswordForm()
    {
        return view('admin.change-password');
    }

    
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::User();

        // Check if the current password matches the user's password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Send password changed notification email
        Mail::to($user->email)->send(new PasswordChangedNotification($user));

        return redirect()->route('admin.dashboard')->with('success', 'Your password has been successfully updated.');
    }    


    
}
