<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneNumberRequest extends FormRequest
{
    public function authorize()
    {
        return true;  
    }

    public function rules()
    {
        return [
            'phone_number' => ['required', 'string', 'regex:/^\+[0-9]+$/'],
            'use_whatsapp' => 'nullable|integer|in:0,1',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'phone_number' => preg_replace('/\s+/', '', $this->phone_number), // Remove white spaces
        ]);
    }

    public function messages()
    {
        return [
            'phone_number.required' => 'The phone number field is required.',
            'phone_number.string' => 'Enter a Valid Number.Example: +44 123 456 7654',
            'phone_number.regex' => 'The phone number format is invalid. Example: +44 123 456 7654',
        ];
    }
}
