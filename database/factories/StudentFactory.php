<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name,
            'birthday' => fake()->date(),
            'phone' => fake()->phoneNumber,
            'qualification' => fake()->text(),
            'email' => fake()->safeEmail,
            'password' => fake()->password,
        ];
    }
}
