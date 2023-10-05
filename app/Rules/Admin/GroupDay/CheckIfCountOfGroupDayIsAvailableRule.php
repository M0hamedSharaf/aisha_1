<?php

namespace App\Rules\Admin\GroupDay;

use Illuminate\Contracts\Validation\Rule;

class CheckIfCountOfGroupDayIsAvailableRule implements Rule
{
    private $maxDaysOfGroup;

    public function __construct()
    {
        //
    }


    public function passes($attribute, $value): bool
    {
//        if(request('group_id'))
//        {
//            $group = Group::find(request('group_id'));
//
//            $this->maxDaysOfGroup = $group->groupType->days_num;
//
//            return  count($value) <= $this->maxDaysOfGroup;
//        }
        return false;
    }


    public function message(): string
    {
        return 'This Group Available For ' . $this->maxDaysOfGroup . 'Days';
    }
}
