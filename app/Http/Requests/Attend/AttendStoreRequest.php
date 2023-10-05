<?php

namespace App\Http\Requests\Attend;

use Illuminate\Foundation\Http\FormRequest;

class AttendStoreRequest extends FormRequest
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
        return
            [
                'student_id' => 'required|exists:students,id',
                'lesson_id' => 'required|exists:lessons,id',
                'date' => 'required',
                'note' => 'nullable',

            ];
    }

    public function messages()
    {
        return [
            'lesson_id.required' => 'هذه الخانة مطلوبة',
            'student_id.required' => 'هذه الخانه مطلوبة',
            'memorized.required' => 'هذه الخانه مطلوبة',
            'date.required' => 'هذه الخانه مطلوبة',
        ];
    }
}
