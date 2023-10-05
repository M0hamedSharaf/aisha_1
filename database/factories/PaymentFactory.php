<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'student_id' => Student::select('id')->InRandomOrder()->first()->id,
            'group_id'   => Group::select('id')->InRandomOrder()->first()->id,
            'amount'     => fake()->numberBetween(50, 200),
            'month'      => fake()->randomElement(getMonthNames()),
            'paid'       => rand(0, 1),
        ];
    }
}