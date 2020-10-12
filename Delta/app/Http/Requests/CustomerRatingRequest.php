<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRatingRequest extends FormRequest
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
            "star_count" => ["required",'integer' ,'between:1,5'],
            "name" => "required",
            "description" => "required",
        ];
    }
    public function messages()
    {
        $messages = new ValidationMessages;

        return [
            'star_count.required' => $messages->require('Stars'),
            'name.required' => $messages->require('Title'),
            'description.required' => $messages->require('Description'),
        ];
    }
}
