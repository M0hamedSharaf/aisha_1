<?php

namespace App\Services\SyllabusReview;

use App\Models\SyllabusReview;

class SyllabusReviewService
{
   
    public function studentHasFaild($syllabusReview)
    {
       return $syllabusReview->update([
            'finished' => true,
            'rate' => "fail"
        ]);
    }
    
    public function studentHasPassed($syllabusReview, $rate)
    {
       return $syllabusReview->update([
            'finished' => true,
            'rate' => $rate
        ]);
    }

    public function createSyllabusReview(object $request, $student_lesson_review_id)
    {
       return SyllabusReview::create([
                'student_lesson_review_id' => $student_lesson_review_id,
                'from_chapter' => $request->from_chapter,
                'to_chapter' => $request->to_chapter,
                'from_page' => $request->from_page,
                'to_page' => $request->to_page,
                'finished' => false,
                'rate' => null,
            ]);
    }

    public function finishNewLessonReview($syllabusReview)
    {
        $studentLessonReview = $syllabusReview->studentLessonReview;
        $lesson = $studentLessonReview->studentLesson->lesson;

        $percentage = $lesson->chapters_count > 0 ? (($syllabusReview->to_chapter / $lesson->chapters_count) * 100) : 0;

        return $studentLessonReview->update([
            'last_page_finished' => $syllabusReview->to_page,
            'last_chapter_finished' => $syllabusReview->to_chapter,
            'percentage' => round($percentage, 2),
            'finished' => $syllabusReview->to_chapter == $lesson->chapters_count ? true : false
        ]);
    }
}