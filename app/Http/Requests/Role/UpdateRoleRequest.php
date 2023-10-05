<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return
            [
                'name' => ['required', 'string', Rule::unique('roles', 'name')->ignore($this->role->id)],
                'display_name' => ['nullable', 'string'],
                'description' => ['nullable', 'string']
            ];
    }
}
