<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function authorize()
    {
        return true;  
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'content.required' => 'The content field is required.',
            'image.required' => 'The image field is required for new posts.',
            'image.image' => 'The image must be a valid image file.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'name' => ucwords($this->name),
        ]);
    }
}
