<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyllabusReview extends Model
{
    use HasFactory;

    protected $fillable = ['student_lesson_review_id', 'from_chapter', 'to_chapter', 'from_page','to_page','finished','rate'];

    public function studentLessonReview()
    {
        return $this->belongsTo(StudentLessonReview::class, 'student_lesson_review_id');
    }
}
