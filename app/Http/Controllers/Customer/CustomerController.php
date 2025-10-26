<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\Traits\CartTrait;
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
    
    // Show the customer dashboard
    public function dashboard()
    {
        return view('customer.dashboard');
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
