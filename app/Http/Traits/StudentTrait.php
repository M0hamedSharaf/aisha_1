<?php


namespace App\Http\Traits;

use App\Models\Student;

trait StudentTrait
{
    private function getStudentsDesc()
    {
        return Student::orderBy('id', 'DESC')->get();
    }

    private function getStudents()
    {
        return Student::get();
    }
}