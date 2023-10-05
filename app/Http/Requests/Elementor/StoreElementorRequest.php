<?php

namespace App\Http\Requests\Elementor;

use Illuminate\Foundation\Http\FormRequest;

class StoreElementorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_ar' => 'required',
            'name_en' => 'required',
            'desc_ar' => 'string',
            'desc_en' => 'string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }
}