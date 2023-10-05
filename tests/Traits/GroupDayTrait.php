<?php

namespace Tests\Traits;

use App\Models\GroupDay;

trait GroupDayTrait
{
    private function generateRandomGroupDay(int $count = 1)
    {
        $group = $this->generateRandomGroup();
        if ($count == 1) {
            return GroupDay::factory()->create([
                'group_id' => $group->id,
            ]);
        }
        return GroupDay::factory($count)->create([
            'group_id' => $group->id
        ]);
    }

    public function generateRandomGroupDayData(): array
    {
        $group = $this->generateRandomGroup();
        return [
            'group_id' => $group->id,
            'from_time' => '06:00',
            'to_time' => '08:00',
            'day' => fake()->dayOfWeek()
        ];
    }
}
