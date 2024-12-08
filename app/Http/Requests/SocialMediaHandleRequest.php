<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaHandleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true; 
    }


    public function rules(): array
    {
        return [
            'handle' => [
                'required',
                'string',
                'regex:/^[A-Za-z-]+$/',
            ],
            'social_media' => 'required|in:facebook,instagram,youtube,tiktok',
        ];
    }

    public function messages(): array
    {
        return [
            'handle.regex' => 'Enter a valid Social Media handle only, not a link, and it must only contain letters or hyphens.',
        ];
    }
}
