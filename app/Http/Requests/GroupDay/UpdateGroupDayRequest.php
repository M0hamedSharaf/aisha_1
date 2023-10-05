<?php

namespace App\Http\Requests\GroupDay;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupDayRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            "group_id" => "required|exists:groups,id",
            'from_time' => ['required', ' date_form:H:i'],
            'to_time' => ['required', ' date_form:H:i', 'after:from_date'],
            "day" => ["required"]
        ];
    }
}
