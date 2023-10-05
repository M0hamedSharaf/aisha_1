<?php

namespace Tests\Traits;

use App\Models\Role;

Trait TestRoleTrait
{
    private function generateRandomRole()
    {
        return fake()->randomElement(getSeededRoles())['name'];
    }

    private function getRandomRole()
    {
        return Role::factory()->create();
    }
}