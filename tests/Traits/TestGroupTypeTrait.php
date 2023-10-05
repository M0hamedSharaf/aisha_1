<?php

namespace Tests\Traits;

use App\Models\GroupType;

trait TestGroupTypeTrait
{
    private function generateRandomGroupType(int $count = 1)
    {
        if ($count == 1) {
            return GroupType::factory()->create();
        }
        return GroupType::factory($count)->create();
    }

    private function generateRandomGroupTypeData()
    {
        return [
            'name'     => fake()->name,
            'days_num' => fake()->numberBetween(1,7),
            'price'    => fake()->numberBetween(20,500),
        ];
    }
}
