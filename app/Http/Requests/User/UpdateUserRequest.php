<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => "required",
            'email' => ['required','email', Rule::unique('users', 'email')->ignore($this->user->id)],
            'password' => 'nullable|confirmed',
            'role' => 'required|exists:roles,name'
        ];
    }
}