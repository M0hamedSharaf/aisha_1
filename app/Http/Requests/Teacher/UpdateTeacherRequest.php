<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
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
        // dd(request());
        return [
            'name' => 'required|max:255',
            'email' => ['required', Rule::unique('teachers', 'email')->ignore($this->teacher->id)],
            'password' => 'nullable|confirmed',
            'role' => 'required|exists:roles,name',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'birthday' => 'nullable',
            'phone' => 'required',
            'qualification' => 'required',
        ];
    }
}
