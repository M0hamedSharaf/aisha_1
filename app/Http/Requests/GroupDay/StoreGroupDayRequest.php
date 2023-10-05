<?php

namespace App\Http\Requests\GroupDay;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupDayRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            "group_id" => "required|exists:groups,id",
            'from_time' => 'required|date_format:H:i',
            'to_time' => 'required|date_format:H:i|after:from_time',
            "day" => ["required"],
        ];
    }
}
