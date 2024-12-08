<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\NewAccountNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    // Show the admin management page
    public function index()
    {
        $users = User::all();
        return view('admin.manage-users', compact('users'));
    }

    // Store a new admin
    public function store(CreateUserRequest $request)
    {
        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->email),
                'notice' => 'change_password_to_activate_account',
            ]);

        // Send email notification 
        Mail::to($user->email)->send(new NewAccountNotification($user, $user->email));

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Update an admin
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Determine ban status and set fields accordingly
        $isBanned = $request->has('ban') && $request->ban === 'on';
        $status = $isBanned ? 0 : 1;
        $notice = $isBanned ? "banned" : null;
    
        // Update the user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $status,
            'notice' => $notice,
        ]);
    
        return back()->with('success', 'User updated successfully.');
    }
    

    // Delete an admin
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
