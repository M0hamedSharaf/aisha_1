<?php

namespace App\Services\StudentLesson;

use App\Models\StudentLesson;

class StudentLessonService
{
    public function store($request)
    {
        $parcentage = ($request->chapters_count / $request->max_chapters) * 100;

        $this->updateOrCreateStudentLesson( (object) [
            'student_id' => $request->student_id,
            'lesson_id' => $request->lesson_id,
            'group_id' => $request->group_id,
            'finished' => false,
            'percentage' => round($parcentage, 2),
            'last_chapter_finished' => intval($request->chapters_count),
            'last_page_finished' => intval($request->last_page_finished),
        ]);
    }

    public function finishStudentLesson(object $request)
    {
        $this->updateOrCreateStudentLesson( (object) [
            'student_id' => $request->student_id,
            'lesson_id' => $request->lesson_id,
            'group_id' => $request->group_id,
            'finished' => true,
            'percentage' => 100,
            'last_chapter_finished' => intval($request->chapters_count),
            'last_page_finished' => intval($request->last_page_finished),
        ]);
    }

    public function unFinishStudentLesson(object $request)
    {
        StudentLesson::where([
            ['student_id' , $request->student_id],
            ['lesson_id' , $request->lesson_id],
            ['group_id' , $request->group_id],
        ])->update([
            'percentage' => 0,
            'finished' => false,
            'last_chapter_finished' => 0,
            'last_page_finished' => 0,
        ]);
    }

    public function isChapterFinished(object $request)
    {
        return $request->max_chapters == $request->chapters_count;
    }

    public function ajaxStudentLessonFinished($request)
    {
        if ($request->finished == "true") {
            $this->updateOrCreateStudentLesson( (object) [
                'student_id' => $request->student_id,
                'lesson_id' => $request->lesson_id,
                'group_id' => $request->group_id,
                'finished' => true,
                'percentage' => 100,
                'last_chapter_finished' => intval($request->chapters_count),
                'last_page_finished' => intval($request->last_page_finished),
            ]);
        } else {
            $this->updateOrCreateStudentLesson( (object) [
                'student_id' => $request->student_id,
                'lesson_id' => $request->lesson_id,
                'group_id' => $request->group_id,
                'finished' => false,
            ]);
        }
    }

    public function updateOrCreateStudentLesson(object $request) : StudentLesson
    {
        return StudentLesson::updateOrCreate([
            'student_id' => $request->student_id,
            'lesson_id' => $request->lesson_id,
            'group_id' => $request->group_id,
        ], [
            'finished' => $request->finished ?? false,
            'percentage' => $request->percentage ?? 0,
            'last_chapter_finished' => $request->last_chapter_finished ?? 0,
            'last_page_finished' => $request->last_page_finished ?? 0,
        ]);
    }

    public function firstOrCreateStudentLesson(object $request)
    {
        return StudentLesson::firstOrCreate([
            'student_id' => $request->student_id,
            'lesson_id' => $request->lesson_id,
            'group_id' => $request->group_id,
        ], [

        ]);
    }


    public function getStudentLessonReview($studentLesson): mixed
    {
        $studentLesson->load(['syllabus', 'lesson.subject', 'student', 'studentLessonReview.syllabusReviews']);

        return  $studentLesson->studentLessonReview;

    }
}
