<?php

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;

class PaymentsUpdateRequest extends FormRequest
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

            'student_id' => 'required|exists:students,id',
            'payed'      => 'required',
            'month'      =>  'required',
            'onte'       => 'nullable'

        ];
    }

    public function messages()
    {
        return [
            'payed.required' => 'هذه الخانة مطلوبة',
            'student_id.required' => 'هذه الخانه مطلوبة',
            'month.required' => 'هذه الخانه مطلوبة',

        ];
    }
}
