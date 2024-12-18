<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;  
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',   
            'middle_name' => 'nullable|string|max:255', 
            'last_name' => 'required|string|max:255',    
            'email' => 'required|email|unique:users,email',  
            'role' => 'required|in:admin,global_admin',  
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
            
            'role.required' => 'The role field is required.',
            'role.in' => 'The role must be either admin or global_admin.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'first_name' => ucwords($this->first_name),
            'middle_name' => ucwords($this->middle_name),
            'last_name' => ucwords($this->last_name),
            'email' => strtolower($this->email),
        ]);
    }
}
