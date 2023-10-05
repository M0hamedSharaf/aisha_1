<?php

namespace App\Http\Requests\Experience;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienceRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => 'required',
            'from' => 'required|date|date_format:Y-m-d|before:today|before:to',
            'to' => 'required|date|date_format:Y-m-d|before:today|after:from',
            'teacher_id' => 'required|exists:teachers,id',
        ];
    }
}