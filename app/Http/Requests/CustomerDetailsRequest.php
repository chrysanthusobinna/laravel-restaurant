<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerDetailsRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'county' => 'nullable|string|max:100',
            'postcode' => 'required|string|max:20',
            'additional_info' => 'nullable|string|max:500',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'name' => ucwords(strtolower($this->name)),
            'email' => strtolower($this->email),
            'address' => strtolower($this->address),
            'city' => ucwords(strtolower($this->city)),
            'state' => ucwords(strtolower($this->state)),
            'county' => $this->county ? ucwords(strtolower($this->county)) : null,
            'postcode' => strtoupper($this->postcode),
        ]);
    }

    /**
     * error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'phone_number.required' => 'The phone number field is required.',
            'address.required' => 'The address field is required.',
            'city.required' => 'The city field is required.',
            'state.required' => 'The state field is required.',
            'postcode.required' => 'The postcode field is required.',
        ];
    }
}
