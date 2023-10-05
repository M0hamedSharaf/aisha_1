<?php
namespace Tests\Services\Group;

use App\Services\Group\GroupService;
use Tests\TestCase;
use Tests\Traits\TestGroupTrait;
use Tests\Traits\TestGroupTypeTrait;
use Tests\Traits\TestTeacherTrait;

class GroupServiceTest extends TestCase
{

    use TestGroupTrait;
    use TestTeacherTrait;
    use TestGroupTypeTrait;

    public function test_create_group()
    {
        $groupObject = $this->app->make(GroupService::class);
        $data = $this->generateRandomGroupData();

        // dd($data);

        $groupObject->createGroup((object)$data);

        $this->assertDatabaseHas('groups',(array) $data);
    }

    public function test_update_experience()
    {
        $groupObject = $this->app->make(GroupService::class);
        $data = $this->generateRandomGroupData();
        $group = $this->generateRandomGroup();

        $groupObject->updateGroup($group ,(object)$data);

        $this->assertDatabaseHas('groups',(array) $data);
    }
}