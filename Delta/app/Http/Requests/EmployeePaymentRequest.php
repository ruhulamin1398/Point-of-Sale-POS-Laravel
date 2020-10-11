<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeePaymentRequest extends FormRequest
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
            "employee_payment_type_id" => "required",
            "amount" => "required",
            "month" => "required",

        ];
    }
    public function messages()
    {
        $messages = new ValidationMessages;

        return [
            'employee_id.required' => $messages->require('Employee'),
            'employee_payment_type_id.required' => $messages->require('Payment Type'),
            'amount.required' => $messages->require('Amount'),
            'month.required' => $messages->require('Month'),
        ];
    }
}
