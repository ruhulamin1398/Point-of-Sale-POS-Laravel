<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DropProductRequest extends FormRequest
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
            "product_id" => "required",
            "quantity" => "required",
        ];
    }

    
public function messages()
{
    $messages = new ValidationMessages;

    return [
        'product_id.required' => $messages->require('Product'),
        'quantity.required' => $messages->require('Quantity'),
    ];
}
}
