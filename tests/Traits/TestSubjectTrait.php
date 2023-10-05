<?php

namespace Tests\Traits;

use App\Models\Subject;

Trait TestSubjectTrait
{
    private function generateRandomSubject(int $count = 1)
    {
        if($count == 1)
        {
            return Subject::factory()->create();
        }

        return Subject::factory($count)->create();
    }

    private function generateRandomSubjectData()
    {
        return [
            'name' => fake()->name,
            'avatar' => fake()->name()
        ];
    }
}