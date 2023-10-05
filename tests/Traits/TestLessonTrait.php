<?php

namespace Tests\Traits;

use App\Models\Lesson;

Trait TestLessonTrait
{
    private function generateRandomLesson(int $count = 1)
    {
        $subject = $this->generateRandomSubject();

        if($count == 1)
        {
            return Lesson::factory()->create([
                'subject_id' => $subject->id
            ]);
        }

        return Lesson::factory($count)->create([
            'subject_id' => $subject->id
        ]);
    }

    private function generateRandomLessonData()
    {
        $subject = $this->generateRandomSubject();

        $from_page = fake()->numberBetween(1, 50);
        $to_page = $from_page + 50;

        return [
            'subject_id' => $subject->id,
            'title' => fake()->text(),
            'chapters_count' => fake()->numberBetween(1,200),
            'from_page' => $from_page,
            'to_page' => $to_page
        ];
    }
}