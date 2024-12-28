<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookTableRequest extends FormRequest
{
 
    protected function prepareForValidation()
    {
        // Apply ucwords to the 'name' field
        $this->merge([
            'name' => ucwords($this->name),
            'email' => strtolower($this->email),
        ]);
    }
 
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'time' => 'required|string',
            'phone' => 'required|string|max:20',
            'date' => 'required|string',
            'persons' => 'required|integer|min:1',
        ];
    }
}
