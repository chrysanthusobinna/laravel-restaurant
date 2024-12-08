<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;  
    }

    public function rules()
    {
        $userId = Auth::id(); // Get the authenticated user's ID

        return [
            'first_name' => 'required|string|max:255',  
            'middle_name' => 'nullable|string|max:255',  
            'last_name' => 'required|string|max:255',  
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'The first name field is required.',
            'first_name.string' => 'The first name must be a string.',
            'first_name.max' => 'The first name must not exceed 255 characters.',
            
            'middle_name.string' => 'The middle name must be a string.',
            'middle_name.max' => 'The middle name must not exceed 255 characters.',
            
            'last_name.required' => 'The last name field is required.',
            'last_name.string' => 'The last name must be a string.',
            'last_name.max' => 'The last name must not exceed 255 characters.',
            
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'This email has already been taken.',
            
            'phone_number.string' => 'The phone number must be a string.',
            'phone_number.max' => 'The phone number may not be greater than 15 characters.',
            
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address may not be greater than 255 characters.',
            
            'profile_photo.image' => 'The profile photo must be an image.',
            'profile_photo.mimes' => 'The profile photo must be a file of type: jpeg, png, jpg.',
            'profile_photo.max' => 'The profile photo may not be greater than 2048 kilobytes.',
        ];
    }
}
