<?php

namespace App\Rules\Admin\Payment;

use App\Models\Group;
use App\models\GroupType;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CheckAmountInGroupPriceRule implements Rule
{


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(Group::where('id', '=', request("group_id"))->exists())
        {
            $getPriceGroupType = Group::where('id', '=', request("group_id"))
            ->with('groupType')
            ->first()->groupType->price;

            if ($getPriceGroupType ===  (float)$value) {

                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'غير مطابق';
    }
}