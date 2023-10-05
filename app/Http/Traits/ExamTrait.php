<?php


namespace App\Http\Traits;

use App\Models\Exam;

trait ExamTrait
{
<<<<<<< HEAD
    private function getExamDesc()
    {
        return Exam::orderBy('id', 'DESC')->get();
    }

    private function getExam()
    {
        return Exam::get();
    }
}
=======
    private function getExamsDesc()
    {
        return Exam::orderBy('id', 'DESC')->get();
        
    }

    private function getExams()
    {
        return Exam::get();
    }
}
>>>>>>> 0594cf6fcacf0275a178a147de0de9c81dd630df
