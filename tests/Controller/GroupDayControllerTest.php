<?php

namespace Tests\Controller;

use App\Models\GroupDay;
use App\Services\GroupDay\GroupDayService;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\MockInterface;
use Tests\TestCaseWithTransLationsSetUp;
use Tests\Traits\GroupDayTrait;
use Tests\Traits\TestGroupTrait;
use Tests\Traits\TestGroupTypeTrait;
use Tests\Traits\TestTeacherTrait;

class GroupDayControllerTest extends TestCaseWithTransLationsSetUp
{
    use WithFaker, GroupDayTrait;
    use TestGroupTrait;
    use TestTeacherTrait;
    use TestGroupTypeTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshApplicationWithLocale('en');
    }

    public function test_index_page_Has_No_Errors()
    {
        $res = $this->get(route('admin.group_day.index'));
        $res->assertOk();
        $res->assertViewIs('pages.groupDays.index');
        $res->assertViewHas('groups');
    }


    /**
     * @dataProvider validationData
     */
    public function test_store_validations($validationData)
    {
        $response = $this->post(route('admin.group_day.store'), $validationData);
        $response->assertSessionHasErrors();
    }

    public function validationData(): array
    {
        $this->refreshApplication();
        $group = $this->generateRandomGroup();

        return [
            "with No Data" => [
                []
            ],
            "with Null Day" => [
                [
                    'day' => null,
                    'group_id' => $group->id,
                    'from_time' => '06:00',
                    'to_time' => '08:00'
                ]
            ],
            "with Null group_id" => [
                [
                    'day' => 'Saturday',
                    'group_id' => null,
                    'from_time' => '06:00',
                    'to_time' => '08:00'
                ]
            ],
            "with group_id that doesn't exist" => [
                [
                    'day' => 'Saturday',
                    'group_id' => intval($group->id + 100),
                    'from_time' => '06:00',
                    'to_time' => '08:00'
                ]
            ],
            "with from_time that is null" => [
                [
                    'day' => 'Saturday',
                    'group_id' => $group->id,
                    'from_time' => null,
                    'to_time' => '08:00'
                ]
            ],
            "with to_time that is null" => [
                [
                    'day' => 'Saturday',
                    'group_id' => $group->id,
                    'from_time' => '06:00',
                    'to_time' => null
                ]
            ],
            "with from_time that is greater than to_time" => [
                [
                    'day' => 'Saturday',
                    'group_id' => $group->id,
                    'from_time' => '08:00',
                    'to_time' => '06:00'
                ]
            ],
        ];
    }

    public function test_store_GroupDay()
    {
        $data = $this->generateRandomGroupDayData();

        $res = $this->post(route('admin.group_day.store'), $data);

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseHas('group_days', $data);
    }

    public function test_can_delete_GroupDay()
    {
        $groupDay = $this->generateRandomGroupDay();

        $res = $this->get(route('admin.group_day.delete', $groupDay));

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('group_days', [
            'id' => $groupDay->id,
        ]);
    }


    public function test_get_groupDays_of_Group_Has_No_Errors()
    {
        $group = $this->generateRandomGroup();

        $response = $this->get(route('admin.group_day.getGroupDaysOfGroup'), [
            'group_id' => $group->id
        ]);

        $response->assertJsonStructure([
            "groupDays"
        ]);
    }
}
