<?php


namespace App\Http\Traits;

use App\Models\Teacher;

trait TeacherTrait
{
    private function getTeachersDesc()
    {
        return Teacher::orderBy('id', 'DESC')->get();
    }

    private function getTeachers()
    {
        return Teacher::get();
    }
}
