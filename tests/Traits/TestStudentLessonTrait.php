<?php

namespace Tests\Traits;

use App\Models\StudentLesson;

Trait TestStudentLessonTrait
{
    private function generateRandomStudentLesson(int $count = 1)
    {
        $student = $this->generateRandomStudent();
        $lesson = $this->generateRandomLesson();

        if($count == 1)
        {
            return StudentLesson::factory()->create([
                'group_id' => $student->groups->first()->id,
                'student_id' => $student->id,
                'lesson_id' => $lesson->id,
            ]);
        }
        return StudentLesson::factory($count)->create([
            'group_id' => $student->groups->first()->id,
            'student_id' => $student->id,
            'lesson_id' => $lesson->id,
        ]);
    }

    private function generateRandomStudentLessonData()
    {
        $student = $this->generateRandomStudent();
        $lesson = $this->generateRandomLesson();

        return [
            'group_id' => $student->groups->first()->id,
            'student_id' => $student->id,
            'lesson_id' => $lesson->id,
        ];
    }
}