<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class TeacherUpdateRequest extends FormRequest
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
            'phone' => 'required|min:11',
            'birthday' => 'nullable|date',
            'note' => 'nullable'
        ];
    }

    public function messages()
    {

       return [
        'name.required' => 'هذه الخانة مطلوبة',
        'phone.required' => 'هذه الخانة مطلوبة'
       ];
    }
}
