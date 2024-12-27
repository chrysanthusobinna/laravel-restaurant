<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonyRequest extends FormRequest
{
 
    public function authorize()
    {
        return true;
    }
 
    protected function prepareForValidation()
    {
        if ($this->has('name')) {
            $this->merge([
                'name' => ucwords($this->name), 
            ]);
        }
    }
 
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',    
            'content' => 'required|string',     
        ];
    }

 
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not exceed 255 characters.',
            'content.required' => 'The content field is required.',
            'content.string' => 'The content must be a string.',
        ];
    }
}
