<?php

namespace Tests\Traits;

use App\Models\Experience;

Trait TestExperienceTrait
{
    private function generateRandomExperience(int $count = 1)
    {
        $teacher = $this->generateRandomTeacher();
        if($count == 1)
        {
            return Experience::factory()->create([
                'teacher_id' => $teacher->id
            ]);
        }
        return Experience::factory($count)->create([
            'teacher_id' => $teacher->id
        ]);
    }
}