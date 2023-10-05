<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLessonReview extends Model
{
    use HasFactory;

    protected $fillable = ['student_lesson_id', 'finished', 'percentage', 'last_chapter_finished','last_page_finished'];

    public function syllabusReviews()
    {
        return $this->hasMany(SyllabusReview::class,'student_lesson_review_id');
    }

    public function studentLesson()
    {
        return $this->belongsTo(StudentLesson::class, 'student_lesson_id');
    }
}
