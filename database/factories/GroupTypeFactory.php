<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroupType>
 */
class GroupTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'     => fake()->unique()->name,
            'price'    => fake()->numberBetween(int1: 50,int2: 2500),
            'days_num' => fake()->numberBetween(2, 6),
        ];
    }
}
