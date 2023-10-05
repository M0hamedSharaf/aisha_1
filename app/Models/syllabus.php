<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class syllabus extends Model
{
    use HasFactory;

    protected $fillable = ['student_lesson_id', 'from_chapter', 'to_chapter', 'from_page','to_page','finished','rate'];

    public function studentLesson()
    {
        return $this->belongsTo(StudentLesson::class, 'student_lesson_id');
    }
}