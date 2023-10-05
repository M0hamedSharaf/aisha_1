<?php

namespace Tests\Traits;

use App\Models\GroupSubject;

trait TestGroupSubjectTrait
{
    private function generateRandomGroupSubject(int $count = 1)
    {
        $group = $this->generateRandomGroup();
        $subject = $this->generateRandomSubject();
        if ($count == 1) {
            return GroupSubject::factory()->create([
                'group_id' => $group->id,
                'subject_id' => $subject->id
            ]);
        }

        return GroupSubject::factory($count)->create([
            'group_id' => $group->id,
            'subject_id' => $subject->id
        ]);
    }

    private function generateRandomGroupSubjectData()
    {
        $group = $this->generateRandomGroup();
        $subject = $this->generateRandomSubject();

        return [
            'group_id' => $group->id,
            'subject_id' => $subject->id
        ];
    }
}
