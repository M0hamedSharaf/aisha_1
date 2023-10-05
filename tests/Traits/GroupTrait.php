<?php

namespace Tests\Traits;

use App\Models\Group;

trait GroupTrait
{
    private function generateRandomGroup(int $count = 1)
    {
        if ($count == 1) {
            return Group::factory()->create();
        }
        return Group::factory($count)->create();
    }
}
