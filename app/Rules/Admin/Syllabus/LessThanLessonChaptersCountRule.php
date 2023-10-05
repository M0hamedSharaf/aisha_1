<?php

namespace App\Rules\Admin\Syllabus;

use App\Models\StudentLesson;
use Illuminate\Contracts\Validation\Rule;

class LessThanLessonChaptersCountRule implements Rule
{

    private $message = '';

    public function passes($attribute, $value)
    {
        if(! request('group_id') || !request('lesson_id') || !request('student_id'))
        {
            $this->message = "the group or student or lesson not found";
            return false;
        }
        
        $studentLesson = StudentLesson::firstOrCreate([
            'group_id' => request('group_id'),
            'lesson_id' => request('lesson_id'),
            'student_id' => request('student_id')
        ],[
            
        ]);
        
        if($value > ($studentLesson->lesson->chapters_count ?? 0))
        {
            $this->message = "The $attribute Should Be Less Than " . $studentLesson->lesson->chapters_count;
            return false;
        }
        return true;
    }

    public function message()
    {
        return $this->message;
    }
}
