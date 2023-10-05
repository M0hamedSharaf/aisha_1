<?php

namespace App\Http\Requests\Exam;

use Illuminate\Foundation\Http\FormRequest;

class ExamUpdateRequest extends FormRequest
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
            'teacher_name' => 'required|exists:teachers,name',
            'title' => 'required|min:11',
            'max_mark' => 'required|numeric',
            'min_mark' => 'required|numeric',
            'note' => 'nullable'
        ];
    }

    public function messages()
    {
        return [

            'teacher_name.required' => 'رجاء الخانة مطلوبة',
            'title.required' => 'رجاء الخانة مطلوبة',
            'max_mark.required' => 'رجاء الخانة مطلوبة',
            'min_mark.required' => 'رجاء الخانة مطلوبة',

        ];
    }
}
