<?php

namespace Tests\Controller;

use Tests\TestCaseWithTransLationsSetUp;
use Tests\Traits\TestGroupTrait;
use Tests\Traits\TestGroupTypeTrait;
use Tests\Traits\TestNoteTrait;
use Tests\Traits\TestStudentTrait;
use Tests\Traits\TestTeacherTrait;
use Tests\Traits\TestUserTrait;

class NoteControllerTest extends TestCaseWithTransLationsSetUp
{
    use TestNoteTrait;
    use TestUserTrait;
    use TestStudentTrait;
    use TestGroupTrait;
    use TestGroupTypeTrait;
    use TestTeacherTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshApplicationWithLocale('en');
    }


    public function test_studentIndex_opens_without_errors()
    {
        $res = $this->call('get', route('admin.note.studentIndex'));

        $res->assertOk();
        $res->assertViewIs('pages.student.note');
        $res->assertViewHas('students');
        $res->assertViewHas('notes');
    }

    /**
     * @test
     * @dataProvider storeValidationProvider
     */
    public function test_studentStore_validations($data)
    {
        $res = $this->call('POST', route('admin.note.studentStore'), $data);

        $res->assertSessionHasErrors();
    }

    public function test_studentStore_pass_with_all_data()
    {
        $data = $this->generateRandomNoteData();

        $res = $this->call('POST', route('admin.note.studentStore'), $data);

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseHas('notes', [
            'notable_id' => $data['student_id'],
            'title' => $data['title'],
            'note' => $data['note'],
            'noteby_id' => $data['noteby_id'],
        ]);
    }

    public function test_Note_get_deleted_without_errors()
    {
        $note = $this->generateRandomNote();

        $res = $this->call('get', route('admin.note.delete', $note->id));

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('notes', [
            'id' => $note->id
        ]);
    }


    public function storeValidationProvider(): array
    {
        $this->refreshApplication();
        $student = $this->generateRandomStudent();

        return [
            "without data" => [
                [],
            ],
            "without a student_id" => [
                [
                    'subject_id' => null,
                    'title' => fake()->name(),
                    'note' => fake()->name(),
                ],
            ],
            "without a title" => [
                [
                    'subject_id' => $student->id,
                    'title' => null,
                    'note' => fake()->name(),
                ],
            ],
            "without a note" => [
                [
                    'subject_id' => $student->id,
                    'title' => fake()->name(),
                    'note' => null,
                ],
            ],
            "with a student that doesn't exist" => [
                [
                    'subject_id' => intval($student->id + 100),
                    'title' => fake()->name(),
                    'note' => fake()->name(),
                ],
            ],
        ];
    }
}
