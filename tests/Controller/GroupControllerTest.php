<?php

namespace Tests\Controller;

use App\Models\Group;
use App\Models\GroupType;
use App\Models\Payment;
use Tests\Traits\TestGroupTrait;
use Tests\Traits\TestTeacherTrait;
use Illuminate\Support\Facades\DB;
use Tests\TestCaseWithTransLationsSetUp;
use Tests\Traits\TestGeneralTrait;
use Tests\Traits\TestGroupTypeTrait;
use Tests\Traits\TestPaymentTrait;
use Tests\Traits\TestStudentTrait;

class GroupControllerTest extends TestCaseWithTransLationsSetUp
{
    use TestTeacherTrait;
    use TestGroupTrait;
    use TestPaymentTrait;
    use TestGroupTypeTrait;
    use TestStudentTrait;
    use TestGeneralTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshApplicationWithLocale('en');
    }

    public function test_index_opens_without_errors()
    {
        $res = $this->call('get', route('admin.group.index'));

        $res->assertOk();
        $res->assertViewHas('teachers');
        $res->assertViewHas('groupTypes');
        $res->assertViewIs('pages.group.index');
    }


    public function test_show_opens_without_errors()
    {
        $group = $this->generateRandomGroup();

        $res = $this->call('get', route('admin.group.show', $group));

        $res->assertOk();
        $res->assertViewHas('group');
        $res->assertViewHas('countStudents');
        $res->assertViewHas('countSubjects');
        $res->assertViewHas('groupDaysCount');
        $res->assertViewHas('groupTypeNumDays');
        $res->assertViewHas('groupPaymentsCount');
        $res->assertViewHas('students');
        $res->assertViewHas('subjects');
        $res->assertViewHas('currentMonth');
        $res->assertViewHas('roles');

        $res->assertViewIs('pages.group.show');
    }

    /**
     * @test
     * @dataProvider storeValidationProvider
     */
    public function test_store_validations($data)
    {
        $res = $this->call('POST', route('admin.group.store'), $data);

        $res->assertSessionHasErrors();
    }

    public function test_store_pass_with_all_data()
    {
        $data = $this->generateRandomGroupData();

        $res = $this->call('POST', route('admin.group.store'), $data);

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseHas('groups', $data);
    }

    /**
     * @dataProvider storeValidationProvider
     */
    public function test_update_validations($data)
    {
        $group = $this->generateRandomGroup();

        $res = $this->call('PUT', route('admin.group.update', $group->id), $data);

        $res->assertSessionHasErrors();
    }

    public function test_update_works_with_all_data()
    {
        $group = $this->generateRandomGroup();
        $data = $this->generateRandomGroupData();

        $res = $this->call('PUT', route('admin.group.update', $group->id), $data);

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseHas('groups', $data);
        $this->assertDatabaseMissing('groups', [
            'id' => $group->id,
            'name' => $group->name,
            'age_type' => $group->age_type,
            'teacher_id' => $group->teacher_id,
            'group_type_id' => $group->group_type_id
        ]);
    }

    public function test_deleted_works_without_errors()
    {
        $group = $this->generateRandomGroup();

        $res = $this->call('get', route('admin.group.delete', $group->id));

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('groups', [
            'id' => $group->id,
            'name' => $group->name,
            'age_type' => $group->age_type,
            'teacher_id' => $group->teacher_id,
            'group_type_id' => $group->group_type_id
        ]);
    }

    public function test_getPaymentPerMonth()
    {
        $group = $this->generateRandomGroup();
        $student = $this->generateRandomStudent();

        Payment::insert([
            [
                'student_id' => $student->id,
                'group_id'   => $group->id,
                'amount'     => 15,
                'month'      => "January",
                'paid'       => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => $student->id,
                'group_id'   => $group->id,
                'amount'     => 60,
                'month'      => "January",
                'paid'       => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => $student->id,
                'group_id'   => $group->id,
                'amount'     => 30,
                'month'      => "February",
                'paid'       => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => $student->id,
                'group_id'   => $group->id,
                'amount'     => 10,
                'month'      => "February",
                'paid'       => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => $student->id,
                'group_id'   => $group->id,
                'amount'     => 10,
                'month'      => "September",
                'paid'       => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        $res = $this->call('get', route('admin.group.getPaymentPerMonth', $group->id));

        $res->assertJson([
            'months' => [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"

            ],
            'values' => [
                75,
                30,
                0,
                0,
                0,
                0,
                0,
                0,
                10,
                0,
                0,
                0,
            ]
        ]);
    }

    public function test_getAllGroupsForPayment()
    {
        $res = $this->call('get', route('admin.group.getAllGroupsForPayment'));

        $res->assertOk();
        $res->assertJsonStructure([
            'status',
            'groups',
            'currentMonth'
        ]);
    }

    public function test_groupAgesChartData()
    {
        $res = $this->call('get', route('admin.group.groupAgesChartData'));

        $groups = Group::select(['id', 'age_type'])->get();

        $res->assertOk();
        $res->assertJson([
            'data' => [
                [
                    'value' => $groups->where('age_type', 'kid')->count()
                ],
                [
                    'value' => $groups->where('age_type', 'adult')->count()
                ],
            ],
            'allGroupsCount' => $groups->count(),
        ]);
    }

    public function storeValidationProvider(): array
    {
        $this->refreshApplication();
        $teacher = $this->generateRandomTeacher();
        $groupType = GroupType::inRandomOrder()->first();

        return [
            "without data" => [
                [],
            ],
            "without a Age Type" => [
                [
                    'teacher_id' => $teacher->id,
                    'group_type_id' => $groupType->id
                ],
            ],
            "without teacher_id" => [
                [
                    'age_type' => Group::GROUP_TYPES[rand(0, 1)],
                    'group_type_id' => $groupType->id
                ],
            ],
            "without group type id" => [
                [
                    'age_type' => Group::GROUP_TYPES[rand(0, 1)],
                    'teacher_id' => $teacher->id,
                ],
            ],
        ];
    }
}
