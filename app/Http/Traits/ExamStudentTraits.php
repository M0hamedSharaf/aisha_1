<?php
// mmmm

namespace App\Http\Traits;


use App\Models\ExamStudent;

trait ExamStudentTraits
{
    private function getExamStudentDesc()
    {
        return ExamStudent::orderBy('id', 'DESC')->get();
    }

}
