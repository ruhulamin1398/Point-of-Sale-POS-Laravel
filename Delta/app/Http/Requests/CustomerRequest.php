<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            "name" => "required",
            "phone" => ["required","unique:customers"],
            
        ];
    }
    public function messages()
    {
        $messages = new ValidationMessages;

        return [
            'name.required' => $messages->require('Name'),
            'phone.required' => $messages->require('Phone'),
            'phone.unique' => $messages->unique('Phone'),
        ];
    }
}
