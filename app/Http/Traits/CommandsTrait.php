<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;


trait CommandsTrait
{
    protected function askValid($question, $field, $rules)
    {
        $value = $this->ask($question);

        if ($message = $this->validateInput($rules, $field, $value)) {
            $this->error($message);

            return $this->askValid($question, $field, $rules);
        }

        return $value;
    }

    protected function validateInput($rules, $fieldName, $value): ?string
    {
        $validator = Validator::make(
            [
                $fieldName => $value
            ],
            [
                $fieldName => $rules
            ]);

        return $validator->fails() ? $validator->errors()->first($fieldName) : null;
    }
}
