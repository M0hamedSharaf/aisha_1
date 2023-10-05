<?php

namespace App\Rules\Admin\StudentLesson;

use App\Models\Lesson;
use Illuminate\Contracts\Validation\Rule;

class CheckLastPageFinishedMaxRule implements Rule
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
        if(request('lesson_id'))
        {
            $lesson = Lesson::find(request('lesson_id'));
            
            if($lesson)
            {
                return $value == $lesson->to_page;
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
        return 'the last page finished is not equal to lesson pages count';
    }
}
