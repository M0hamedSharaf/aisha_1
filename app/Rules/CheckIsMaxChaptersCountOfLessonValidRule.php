<?php

namespace App\Rules;

use App\Models\Lesson;
use Illuminate\Contracts\Validation\Rule;

class CheckIsMaxChaptersCountOfLessonValidRule implements Rule
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

    public function passes($attribute, $value) :bool
    {
       $chapters_countOfLesson = Lesson::find(request('lesson_id'))->chapters_count;

        return $chapters_countOfLesson == $value;

    }


    public function message() :string
    {
        return 'The Chapters Count Of Student Lesson Must Equal Chapters Count Of This Lesson ';
    }
}
