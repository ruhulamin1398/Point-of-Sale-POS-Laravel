<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "name" => 'required|unique:users',
            "email" => 'required|unique:users',
            "password" => "required",

        ];
    }

    public function messages()
    {
        $messages = new ValidationMessages;

        return [
            'employee_id.required' => $messages->require('Employee'),
            'name.required' => $messages->require('Username'),
            'email.required' => $messages->require('Email'),
            'password.required' => $messages->require('Password'),
            'email.unique' => $messages->unique('Email'),
            'name.unique' => $messages->unique('UserName'),

        ];
    }
}
