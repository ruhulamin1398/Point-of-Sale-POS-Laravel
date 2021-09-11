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
            
            "name"=>"required",
            "phone"=>["required","unique:employees"],
            "address"=>"required",
            "designation_id"=>"required",
           
        ];

    }

    public function messages()
    {
        $messages = new ValidationMessages;

        return [
            'name.required' => $messages->require('Name'),
            'phone.required' => $messages->require('Phone'),
            'phone.unique' => $messages->unique('Phone'),
            'address.required' => $messages->require('Address'),
            'salary.required' => $messages->require('Salary'),
            'designation_id.required' => $messages->require('Designation'),
        ];
    }
}
