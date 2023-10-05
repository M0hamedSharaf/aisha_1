<?php

namespace App\Services\StudentLessonReview;

use App\Models\StudentLessonReview;

class StudentLessonReviewService
{
    public  $studentLesson;

    public function firstOrCreateStudentLessonReview($student_lesson_id)
    {
        return StudentLessonReview::firstOrCreate([
                'student_lesson_id' => $student_lesson_id
            ], [

            ]);
    }

    public function finished(object $request)
    {
        StudentLessonReview::updateOrCreate([
            'student_lesson_id'     => $request->student_lesson_id
        ], [
            'finished'              => true,
            'percentage'            => 100,
            'last_chapter_finished' => $request->chapters_count,
            'last_page_finished'    => $request->last_page_finished,
        ]);
    }

    public function notFinished(object $request)
    {
        StudentLessonReview::updateOrCreate([
            'student_lesson_id'     =>  $request->student_lesson_id
        ], [
            'finished' => false,
            'percentage'  => 0,
        ]);
    }

    public function update($syllabusReview)
    {
        $studentLessonReview = $syllabusReview->studentLessonReview;

        $lesson = $studentLessonReview->studentLesson->lesson;

        $percentage = $lesson->chapters_count > 0 ? (($syllabusReview->to_chapter / $lesson->chapters_count) * 100) : 0;

        $studentLessonReview->update([
            'last_page_finished' => $syllabusReview->to_page,
            'last_chapter_finished' => $syllabusReview->to_chapter,
            'percentage' => round($percentage, 2),
            'finished' => $syllabusReview->to_chapter == $lesson->chapters_count ? true : false
        ]);

        return $studentLessonReview;
    }
}
