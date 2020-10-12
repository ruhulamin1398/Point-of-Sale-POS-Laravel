<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReturnProductRequest extends FormRequest
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
            "customer_id" => "required",
            "quantity" => "required",
            "price" => "required",

        ];
    }
    public function messages()
        {
            $messages = new ValidationMessages;
    
            return [
                'product_id.required' => $messages->require('Product id'),
                'customer_id.required' => $messages->require('Customer id'),
                'quantity.required' => $messages->require('Quantity'),
                'price.required' => $messages->require('Price'),

            ];
        }
}
