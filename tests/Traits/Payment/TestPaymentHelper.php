<?php
namespace Tests\Traits\Payment;

use Tests\Traits\TestGroupTrait;
use Tests\Traits\TestStudentTrait;

class TestPaymentHelper
{
    use TestGroupTrait;
    use TestStudentTrait;

    /**
     * keys
     * created_at
     * group_id
     * student_id
     * amount
     */
    public function generate(array $configs)
    {
        $group = $this->generateRandomGroup();
        $student = $this->generateRandomStudent();

        $data = [
            'group_id' => $group->id,
            'student_id' => $student->id,
            'amount' => $group->groupType->price,
            'month' => fake()->randomElement(getMonthNames()),
            'paid' => fake()->boolean(),
            'created_at' => $configs['created_at']
        ];

        foreach($configs as $columnName => $value)
        {
            $data[$columnName] = $value;
        }
    }

    // return [
            //     'group_id' => $group->id,
            //     'student_id' => $student->id,
            //     'amount' => $group->groupType->price,
            //     'month' => fake()->randomElement(getMonthNames()),
            //     'paid' => fake()->boolean(),
            //     'created_at' => $configs['created_at']
            // ];


}