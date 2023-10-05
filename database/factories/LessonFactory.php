<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $from_page = fake()->numberBetween(1, 50);
        $to_page = $from_page + 50;

        return [
            'title' => fake()->text(),
            'chapters_count' => fake()->numberBetween(1,200),
            'from_page' => $from_page,
            'to_page' => $to_page
        ];
    }
}
