<?php

namespace Database\Factories;

use App\Models\GroupDay;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GroupDay>
 */
class GroupDayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'from_time' => '06:00',
            'to_time' => '08:00',
            'day' => fake()->dayOfWeek()
        ];
    }
}
