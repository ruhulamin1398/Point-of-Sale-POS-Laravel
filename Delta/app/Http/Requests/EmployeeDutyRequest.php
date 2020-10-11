<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeDutyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "employee_id" => "required",
            "duty_status_id" => "required",
            "date" => "required",
        ];
    }
    
    public function messages()
    {
        $messages = new ValidationMessages;

        return [
            'employee_id.required' => $messages->require('Employee'),
            'duty_status_id.required' => $messages->require('Duty Status'),
            'date.required' => $messages->require('Date'),
        ];
    }
}
