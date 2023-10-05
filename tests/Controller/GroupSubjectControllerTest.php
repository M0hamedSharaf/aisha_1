<?php

namespace Tests\Controller;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCaseWithTransLationsSetUp;
use Tests\Traits\TestGroupSubjectTrait;
use Tests\Traits\TestGroupTrait;
use Tests\Traits\TestGroupTypeTrait;
use Tests\Traits\TestSubjectTrait;
use Tests\Traits\TestTeacherTrait;

class GroupSubjectControllerTest extends TestCaseWithTransLationsSetUp
{
    use WithFaker;
    use TestGroupTrait;
    use TestGroupTypeTrait;
    use TestSubjectTrait;
    use TestGroupSubjectTrait;
    use TestTeacherTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshApplicationWithLocale('en');
    }

    public function test_index_page_Has_No_Errors()
    {
        $res = $this->get(route('admin.group_subjects.index'));
        $res->assertOk();
        $res->assertViewIs('pages.groupSubject.index');
        $res->assertViewHas('groups');
        $res->assertViewHas('subjects');
    }


    /**
     * @dataProvider validationData
     */
    public function test_store_validations($validationData)
    {
        $response = $this->post(route('admin.group_subjects.store'), $validationData);
        $response->assertSessionHasErrors();
    }

    public function validationData(): array
    {
        $this->refreshApplication();
        $group = $this->generateRandomGroup();
        $subject = $this->generateRandomSubject();

        return [
            "without data" => [
                [],
            ],
            "without a group_id" => [
                [
                    'subject_id' => $subject->id,
                    'group_id' => null,
                ],
            ],
            "without a subject_id" => [
                [
                    'subject_id' => null,
                    'group_id' => $group->id,
                ],
            ],
        ];
    }

    public function test_store_pass_with_all_data()
    {
        $data = $this->generateRandomGroupSubjectData();

        $res = $this->post(route('admin.group_subjects.store'), $data);

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseHas('group_subjects', $data);
    }

    public function test_delete_pass()
    {
        $groupSubject = $this->generateRandomGroupSubject();

        $res = $this->get(route('admin.group_subjects.delete', $groupSubject->id));

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('group_subjects', [
            'id' => $groupSubject->id,
        ]);
    }


    public function test_get_getGroupSubjects_Has_No_Errors()
    {
        $group = $this->generateRandomGroup();

        $response = $this->get(route('admin.group_subjects.getGroupSubjects', [
            'group_id' => $group->id
        ]));

        $response->assertJsonStructure([
            "groupSubjects"
        ]);
    }
}
