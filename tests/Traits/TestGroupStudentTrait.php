<?php

namespace Tests\Traits;

use App\Models\GroupStudent;

trait TestGroupStudentTrait
{
    private function generateRandomGroupStudent(int $count = 1, $columns = [])
    {
        $group = $this->generateRandomGroup();
        $student = $this->generateRandomStudent();

        $data = [
            'group_id' => $group->id,
            'student_id' => $student->id
        ];

        foreach($columns as $column => $value)
        {
            $data[$column] = $value;
        }

        if ($count == 1) {
            return GroupStudent::factory()->create($data);
        }
        return GroupStudent::factory($count)->create($data);
    }

    private function generateRandomGroupStudentData()
    {
        $group = $this->generateRandomGroup();
        $student = $this->generateRandomStudent();
        
        return [
            'group_id' => $group->id,
            'student_id' => $student->id
        ];
    }
}
