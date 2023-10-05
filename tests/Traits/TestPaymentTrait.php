<?php

namespace Tests\Traits;

use App\Models\Payment;

Trait TestPaymentTrait
{
    private function generateRandomPaymentsForGroup($group_id)
    {
        return Payment::factory(10)->create([
            'group_id' => $group_id
        ]);
    }

    private function generateRandomPaymentsData($created_at = null)
    {
        $group = $this->generateRandomGroup();
        $student = $this->generateRandomStudent();
        return [
            'group_id' => $group->id,
            'student_id' => $student->id,
            'amount' => $group->groupType->price,
            'month' => fake()->randomElement(getMonthNames()),
            'paid' => fake()->boolean(),
            'created_at' => $created_at || now()
        ];
    }

    private function generateRandomPaymentsDataCustomed(array $configs)
    {
        $group = $this->generateRandomGroup();
        $student = $this->generateRandomStudent();

        $data = [
            'group_id' => $group->id,
            'student_id' => $student->id,
            'amount' => $group->groupType->price,
            'month' => fake()->randomElement(getMonthNames()),
            'paid' => fake()->boolean(),
        ];

        foreach($configs as $columnName => $value)
        {
            $data[$columnName] = $value;
        }
        return $data;
    }

    private function generateRandomPaymentsCustomed(array $configs = [], int $count = 1)
    {
        $data = $this->generateRandomPaymentsDataCustomed($configs);
        
        if($count == 1)
        {
            return Payment::factory()->create($data);
        }
        return Payment::factory($count)->create($data);
    }
}