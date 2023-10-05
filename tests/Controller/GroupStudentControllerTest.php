<?php

namespace Tests\Controller;

use App\Models\GroupStudent;
use Tests\TestCaseWithTransLationsSetUp;
use Tests\Traits\TestGroupStudentTrait;
use Tests\Traits\TestGroupTrait;
use Tests\Traits\TestGroupTypeTrait;
use Tests\Traits\TestStudentTrait;
use Tests\Traits\TestTeacherTrait;

class GroupStudentControllerTest extends TestCaseWithTransLationsSetUp
{
    use TestGroupTrait;
    use TestStudentTrait;
    use TestGroupStudentTrait;
    use TestTeacherTrait;
    use TestGroupTypeTrait;
    use TestStudentTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshApplicationWithLocale('en');
    }

    public function test_index_opens_without_errors()
    {
        $res = $this->call('get', route('admin.group_students.index'));

        $res->assertOk();
        $res->assertViewIs('pages.groupStudent.index');
        $res->assertViewHas('groups');
        $res->assertViewHas('students');
    }


    public function test_store_pass_with_all_data()
    {
        $data = $this->generateRandomGroupStudentData();

        $res = $this->call('POST', route('admin.group_students.store'), $data);

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseHas('group_students', $data);
    }

    /**
     * @test
     * @dataProvider storeValidationProvider
     */
    public function test_store_validations($data)
    {
        $res = $this->call('POST', route('admin.group_students.store'), $data);

        $res->assertSessionHasErrors();
    }

    public function storeValidationProvider(): array
    {
        $this->refreshApplication();
        $student = $this->generateRandomStudent();
        $group = $this->generateRandomGroup();

        return [
            "without data" => [
                [],
            ],
            "without a student_id" => [
                [
                    'student_id' => null,
                    'group_id' => $group->id,
                ],
            ],
            "without a group_id" => [
                [
                    'student_id' => $student->id,
                    'group_id' => null,
                ],
            ],
        ];
    }

    public function test_delete_works_without_errors()
    {
        $groupStudent = $this->generateRandomGroupStudent();

        $res = $this->call('get', route('admin.group_students.delete', $groupStudent->id));

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('group_students', [
            'id' => $groupStudent->id
        ]);
    }

    public function test_getGroupStudents_Has_No_Errors()
    {
        $group = $this->generateRandomGroup();

        $response = $this->call('get', route('admin.group_students.getGroupStudents'), [
            'group_id' => $group->id
        ]);

        $response->assertJsonStructure([
            'groupStudents'
        ]);
    }

    public function test_getStudentGroups_Has_No_Errors()
    {
        $student = $this->generateRandomStudent();

        $response = $this->call('get', route('admin.group_students.getStudentGroups'), [
            'student_id' => $student->id
        ]);

        $response->assertJsonStructure([
            'studentGroups'
        ]);
    }
}
