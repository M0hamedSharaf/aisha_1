<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => "teacher__" . $this->faker->name(),
            'birthday' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber(),
            'note' => $this->faker->text()
        ];
    }
}
