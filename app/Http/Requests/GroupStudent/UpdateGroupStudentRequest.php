<?php

namespace App\Http\Requests\GroupStudent;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupStudentRequest extends FormRequest
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
            'student_id' => "required|exists:students,id",
            'group_id' => "required|exists:students,id",
        ];
    }
}
