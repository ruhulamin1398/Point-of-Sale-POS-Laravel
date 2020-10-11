<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Http\Requests\ValidationMessages;

class EmployeeRequest extends FormRequest
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
            
            "user_id"=>"required",
            "name"=>"required",
            "phone"=>["required","unique:employees"],
            "address"=>"required",
            "salary"=>"required",
            "fixed_duty_hour"=>"required",
            "designation_id"=>"required",
           
        ];

    }

    public function messages()
    {
        $messages = new ValidationMessages;

        return [
            'user_id.required' => $messages->require('User'),
            'name.required' => $messages->require('Name'),
            'phone.required' => $messages->require('Phone'),
            'phone.unique' => $messages->unique('Phone'),
            'address.required' => $messages->require('Address'),
            'salary.required' => $messages->require('Salary'),
            'fixed_duty_hour.required' => $messages->require('Fixed Duty Hour'),
            'designation_id.required' => $messages->require('Designation'),
        ];
    }
}
