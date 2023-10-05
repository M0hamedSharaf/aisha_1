<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GroupStudent extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'group_id'];


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function checkIfLessonIsFinished($lesson_id)
    {
        return ($this->getStudentLessonFromLesson($lesson_id)->finished ?? false) == true;
    }

    public function getStudentLessonChaptersCount($lesson_id)
    {
        return $this->getStudentLessonFromLesson($lesson_id)->chapters_count ?? 0;
    }

    public function getStudentLessonFromLesson($lesson_id)
    {
        return $this->group->studentLessons->where('lesson_id', $lesson_id)->first();
    }

    public function getStudentLessonPercentage($lesson_id)
    {
        return $this->getStudentLessonFromLesson($lesson_id)->percentage ?? 0;
    }

    public function scopeGroupStudents($query)
    {
        if(getGuard() == 'admin')
        {
            return $query->select([
                    'group_students.id',
                    'student_id',
                    'group_id'
                ]);
        }
        else if(getGuard() == 'teacher')
        {
            return Auth::guard(getGuard())->user()->groupStudents()->select([
                'group_students.id',
                'student_id',
                'group_id'
            ])->getQuery();
        }
        else if(getGuard() == "student")
        {
            return Auth::guard(getGuard())->user()->groupStudents()->select([
                'group_students.id',
                'student_id',
                'group_id'
            ])->getQuery();

        }
    }
}

