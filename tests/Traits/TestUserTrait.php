<?php

namespace Tests\Traits;

use App\Models\User;

Trait TestUserTrait
{
    private function generateRandomUser(int $count = 1)
    {
        if($count == 1)
        {
            return User::factory()->create();
        }
        return User::factory($count)->create();
    }

    private function generateRandomUserData()
    {
        $password = fake()->password;

        return [
            'name'          => fake()->name,
            'email' => fake()->email,
            'password' => $password,
            'password_confirmation' => $password,
            'role' => fake()->randomElement(getSeededRoles())['name']
        ];
    }
}