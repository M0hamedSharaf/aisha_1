<?php

namespace App\Http\Requests\Payment;

use App\Rules\Admin\Payment\CheckAmountInGroupPriceRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "student_id" => 'required|exists:students,id',
            "group_id" => 'required|exists:groups,id',
            "amount" => ['required', new CheckAmountInGroupPriceRule],
            "month" => ['required', 
                Rule::in(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])
            ],
            "paid" => 'required',
        ];
    }
}