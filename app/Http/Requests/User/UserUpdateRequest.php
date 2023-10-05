<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email',

        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'هذه الخانة مطلوبة',
            'email.required' => 'هذه الخانه مطلوبة',
            'email.email' => 'هذه الخانه يجب ان تحتوي علي بريد الكتروني',
            'password.required' => 'هذه الخانه مطلوبة',
            'password.min' => 'يجب ان تزيد كلمه السر عن ثلاثه احرف',
            'password.confirmed' => 'كلمه السر غير متطابقه',

        ];
    }
}
