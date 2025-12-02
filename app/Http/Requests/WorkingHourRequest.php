<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkingHourRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'day_of_week' => [
                'required',
                Rule::in([
                    'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
                ])
            ],

            // Only required if NOT closed
            'opens_at' => [
                'nullable',
                'date_format:H:i',
                'required_without:is_closed',
            ],

            'closes_at' => [
                'nullable',
                'date_format:H:i',
                'required_without:is_closed',
            ],

            // Checkbox (0 or 1)
            'is_closed' => ['nullable', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'day_of_week.required' => 'Please select a day of the week.',
            'day_of_week.in'       => 'Invalid day selected.',

            'opens_at.required_without' => 'Opening time is required unless the day is marked as closed.',
            'closes_at.required_without' => 'Closing time is required unless the day is marked as closed.',
        ];
    }
}
