<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\Traits\CartTrait;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Controllers\Traits\OrderNumberGeneratorTrait;
use App\Http\Controllers\Traits\MainSiteViewSharedDataTrait;

class CustomerController extends Controller
{


    use CartTrait;
    use MainSiteViewSharedDataTrait;
    use OrderNumberGeneratorTrait;


    public function __construct()
    {
        $this->shareMainSiteViewData();
    }

    public function orders($filter = 'all')
    {
        $user = Auth::user();

        // Allowed status filters
        $allowedFilters = ['all', 'pending', 'completed', 'cancelled'];

        // Validate filter
        if (!in_array($filter, $allowedFilters)) {
            $filter = 'all';
        }

        // Base query — only orders the customer owns AND must be paid
        $ordersQuery = $user->customerOrders()
                            ->where('status_online_pay', 'paid')
                            ->with('orderItems');

        // Apply status filter
        if ($filter !== 'all') {
            $ordersQuery->where('status', $filter);
        }

        $orders = $ordersQuery->orderBy('created_at', 'desc')->get();

        return view('customer.orders', compact('user', 'orders', 'filter'));
    }



    public function orderDetails($id)
    {
        $user = Auth::User();  
        $order = $user->customerOrders()->with(['orderItems', 'deliveryAddressWithTrashed', 'pickupAddress'])->findOrFail($id);

        return view('customer.order-details', compact('user', 'order'));
    }

    // Show the customer account
    public function account()
    {
        $user = Auth::User();  
        return view('customer.account', compact('user'));
    }




        public function editAccount()
    {
        $user = Auth::User();  
        return view('customer.edit-account', compact('user'));
    }

    public function updateAccount(UpdateProfileRequest $request)
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
        return redirect()->route('customer.account')->with('success', 'Profile updated successfully.');
    }
    

    public function showChangePasswordForm()
    {
        $user = Auth::User();

        return view('customer.change-password', compact('user'));
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


    // Show the account creation form
    public function create()
    {
        return view('customer.create-account');
    }

    // Store a new customer
    public function store(Request  $request)
    {
        // user role as customer
        $request->merge(['role' => 'customer']);

        // Validate using CreateUserRequest rules
        $validated = app(CreateUserRequest::class)->validateResolved();

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role' =>  $request->role,
            'password' => Hash::make($request->password),
            'notice' => null,
            'status' => 1,
        ]);

        if ($user) {

            // try {
            //     // Send email welcome message
            //     Mail::to($user->email)->send(new NewAccountNotification($user, $user->email));
            //     $message = ['success' => 'User created successfully. Login details sent to user email.'];
            // } catch (TransportExceptionInterface $e) {
    
            //     $message = [
            //         'success' => 'User created successfully.',
            //         'error' => 'Failed to send email: ' . $e->getMessage()
            //     ];
            // }

            $message = ['success' => 'Account created successfully. You can now log in.'];
            auth()->login($user);
            return redirect()->route('home')->with($message);
        } else {
            $message = ['error' => 'Failed to create account. Please try again.'];
            return redirect()->back()->withInput()->with($message);
        }

    }

}
