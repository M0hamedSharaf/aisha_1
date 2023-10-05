<?php

namespace App\Services\Syllabus;

use App\Models\syllabus;

class SyllabusService
{
    public function createSyllabus(object $request, $student_lesson_id)
    {
        return syllabus::create([
            'student_lesson_id' => $student_lesson_id,
            'from_chapter' => $request->from_chapter,
            'to_chapter' => $request->to_chapter,
            'from_page' => $request->from_page,
            'to_page' => $request->to_page,
            'finished' => false
        ]);
    }

    public function checkIfStudentLessonNotFinished($student_lesson_id)
    {
        return  syllabus::where([
            ['student_lesson_id', $student_lesson_id],
            ['finished', false]
        ])->exists();
    }

    public function updateSyllabusFinished($request, $syllabus)
    {
        return $syllabus->update([
            'finished' => true,
            'rate' => $request->rate
        ]);
    }


    public function finishNewLesson($syllabus)
    {
        $studentLesson = $syllabus->studentLesson;
        $lesson = $studentLesson->lesson;

        $percentage = ($syllabus->to_chapter / $lesson->chapters_count) * 100;

        $studentLesson->update([
            'last_page_finished' => $syllabus->to_page,
            'last_chapter_finished' => $syllabus->to_chapter,
            'percentage' => round($percentage, 2),
            'finished' => $syllabus->to_chapter == $lesson->chapters_count ? true : false
        ]);

        return $studentLesson;
    }
}
