<?php

namespace App\Rules\Admin\Syllabus;

use App\Models\StudentLesson;
use Illuminate\Contracts\Validation\Rule;

class LessThanLessonPagesNumberRule implements Rule
{

    private $message = '';
    private $studentLesson;

    public function passes($attribute, $value)
    {

        if(! request('group_id') || !request('lesson_id') || !request('student_id'))
        {
            $this->message = "the group or student or lesson not found";
            return false;
        }

        $this->studentLesson = StudentLesson::firstOrCreate([
            'group_id' => request('group_id'),
            'lesson_id' => request('lesson_id'),
            'student_id' => request('student_id')
        ],[
            
        ]);

        if($this->lessThanLessonPages($value))
        {
            $this->message = "The $attribute Should Be Greater Than " . $this->studentLesson->lesson->from_page;
            return false;
        }
        else if($this->greaterThanLessonPages($value))
        {
            $this->message = "The $attribute Should Be Less Than " . $this->studentLesson->lesson->to_page;
            return false;
        }
        return true;
    }

    private function lessThanLessonPages($value)
    {
        return $value < $this->studentLesson->lesson->from_page;
    }

    private function greaterThanLessonPages($value)
    {
        return $value > $this->studentLesson->lesson->to_page;
    }

    public function message()
    {
        return $this->message;
    }
}
