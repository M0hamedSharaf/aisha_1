<?php

namespace App\Http\Requests\Student;

use App\Rules\Global\CheckIsFaieldStringRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => ["required", "string",
                Rule::unique('students', 'name')->ignore($this->student->id),
                new CheckIsFaieldStringRule(),
            ],
            'email' => ['required','email',
                Rule::unique('students', 'email')->ignore($this->student->id)
            ],
            'password' => ['nullable', 'confirmed'],
            'role' => ['required', Rule::exists('roles', 'name')],
            "birthday" => ["nullable", "date"],
            "phone" => ["nullable", "string"],
            "qualification" => ["nullable", "string"],
        ];
    }
}
