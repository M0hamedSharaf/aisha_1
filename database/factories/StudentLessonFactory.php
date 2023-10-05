<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentLesson>
 */
class StudentLessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "finished" => fake()->boolean(),
            'percentage' => fake()->numberBetween(0,1),
            'last_chapter_finished' => fake()->numberBetween(1,50),
            'last_page_finished' => fake()->numberBetween(1,50),
        ];
    }
}
