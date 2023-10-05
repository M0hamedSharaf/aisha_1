<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;

class GroupStoreRequest extends FormRequest
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
            'teacher_id' => 'required|exists:teachers,id',
            'type' => 'required|in:kids,mid,mom',
            'note' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'هذه الخانة مطلوبة',
            'teacher_id.required' => 'هذه الخانه مطلوبة',
            'type.required' => 'هذه الخانه مطلوبة',
            'name.min' => 'يجب ان يزيد الاسم عن ثلاثه احرف',
        ];
    }
}
