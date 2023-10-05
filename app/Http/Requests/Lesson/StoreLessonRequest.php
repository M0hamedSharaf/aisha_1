<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
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
            'subject_id' => "required|exists:subjects,id",
            'title' => "required",
            'chapters_count' => "required",
            'from_page' => 'required|integer|lte:to_page',
            'to_page' => 'required|integer',
        ];
    }
}
