<?php


namespace App\Http\Traits;

use App\Models\Lesson;

trait LessonTrait
{
    private function getLessons()
    {
        return Lesson::get();
    }
    private function getLessonsDesc()
    {
        return Lesson::orderBy('id', 'DESC')->get();
    }
}
