<?php

namespace App\Rules\Global;

use Illuminate\Contracts\Validation\Rule;

class CheckIsFaieldStringRule implements Rule
{

    public function __construct()
    {
        //
    }


    public function passes($attribute, $value) :bool
    {
        return preg_match('/[^0-9]/',$value);
    }


    public function message() :string
    {
        return 'This Failed Doesn\'t Accept Numbers Or Special Characters ';
    }
}
