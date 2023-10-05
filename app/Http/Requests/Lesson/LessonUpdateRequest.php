<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class LessonUpdateRequest extends FormRequest
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
            'day' => 'required|in:' . getTypesInString(getLessonDay()),
            'group_id' => 'required|exists:groups,id',
            'from' => 'required',
            'to' => 'required',
            'note' => 'nullable',
        ];
    }

    public function messages()
    {
        return[
            'day.required' => 'هذه الخانة مطلوبة',
            'group_id.required' => 'هذه الخانة مطلوبة',
            'from.required' => 'هذه الخانة مطلوبة',
            'to.required' => 'هذه الخانة مطلوبة',

        ];
    }
}
