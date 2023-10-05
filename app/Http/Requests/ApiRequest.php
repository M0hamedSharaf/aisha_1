<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

abstract class ApiRequest extends FormRequest
{
    abstract public function authorize();

    abstract public function rules();

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        if(! empty($errors))
        {
            $transformedErrors = [];
            foreach($errors as $field => $messages)
            {
                $transformedErrors []= [
                    $messages[0]
                ];
            }
        }

        throw new HttpResponseException(
            response()->json([
                'status' =>  JsonResponse::HTTP_BAD_REQUEST,
                'errors' => $transformedErrors
            ],
            JsonResponse::HTTP_BAD_REQUEST)
        );
    }
}