<?php

namespace Tests\Traits;

use App\Models\Note;
use App\Models\Student;
use App\Models\User;

Trait TestNoteTrait
{
    private function generateRandomNote(int $count = 1)
    {
        $student = $this->generateRandomStudent();
        $user = $this->generateRandomUser();

        if($count == 1)
        {
            return Note::factory()->create([
                'notable_id' => $student->id,
                'noteby_id' => $user->id
            ]);
        }
        return Note::factory($count)->create([
            'notable_id' => $student->id,
            'noteby_id' => $user->id
        ]);
    }

    private function generateRandomNoteData()
    {
        $student = $this->generateRandomStudent();
        $user = $this->generateRandomUser();

        return [
            'student_id' => $student->id,
            'title' => fake()->name(),
            'note' => fake()->text(50),
            'noteby_id' => $user->id
        ];
    }
}