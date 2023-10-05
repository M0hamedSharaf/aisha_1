<?php

namespace App\Rules\Admin\StudentLesson;

use App\Models\Lesson;
use Illuminate\Contracts\Validation\Rule;

class CheckLessonChaptersCountMaxRule implements Rule
{
    
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        if(request('lesson_id'))
        {
            $lesson = Lesson::find(request('lesson_id'));
            if($lesson)
            {
                return $value == $lesson->chapters_count;
            }
        }
        return false;
    }
    
    public function message()
    {
        return 'the chapters are not equal to the lesson chapters count';
    }
}
