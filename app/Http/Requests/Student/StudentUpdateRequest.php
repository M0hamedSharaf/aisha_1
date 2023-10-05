<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
            'brithday' => 'nullable|date',
            'phone' => 'required|min:11',
            'type' => 'required|in:' . getTypesInString(getStudentTypes()),
            'note' => 'nullable',
            'group_id' => 'required|exists:groups,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'هذه الخانة مطلوبة',
            'brithday.required' => 'هذه الخانة مطلوبة',
            'phone.required' => 'هذه الخانة مطلوبة',
            'type.required' => 'هذه الخانة مطلوبة',
            'group_id.required' => 'هذه الخانة مطلوبة',

        ];
    }
}
