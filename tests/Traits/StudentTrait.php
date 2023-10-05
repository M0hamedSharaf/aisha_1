<?php

namespace Tests\Traits;

use App\Models\Student;

trait StudentTrait
{
    private function generateRandomStudent(int $count = 1)
    {
        if ($count == 1) {
            return Student::factory()->create();
        }
        return Student::factory($count)->create();
    }
}
