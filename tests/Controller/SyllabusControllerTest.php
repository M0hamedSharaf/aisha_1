<?php

namespace Tests\Controller;

use Tests\TestCaseWithTransLationsSetUp;
use Tests\Traits\TestGroupTrait;
use Tests\Traits\TestGroupTypeTrait;
use Tests\Traits\TestLessonTrait;
use Tests\Traits\TestStudentTrait;
use Tests\Traits\TestSubjectTrait;
use Tests\Traits\TestTeacherTrait;

class SyllabusControllerTest extends TestCaseWithTransLationsSetUp
{
    use TestGroupTrait;
    use TestLessonTrait;
    use TestStudentTrait;
    use TestTeacherTrait;
    use TestGroupTypeTrait;
    use TestSubjectTrait;

    public function setUp() : void
    {
        parent::setUp();
        
        $this->refreshApplicationWithLocale('en');
    }

    public function test_create_new_lesson_passes()
    {
        $group = $this->generateRandomGroup();
        $lesson = $this->generateRandomLesson();
        $student = $this->generateRandomStudent();

        $data = [
            'group_id' => $group->id,
            'lesson_id' => $lesson->id,
            'student_id' => $student->id,
            'from_chapter' => 1,
            'to_chapter' => $lesson->chapters_count - 1,
            'from_page' => $lesson->from_page + 1,
            'to_page' => $lesson->to_page - 1,
        ];

        $res = $this->call('POST', route('admin.syllabus.createNewLesson', $data));

        $res->assertSessionHasNoErrors();
    }

    /**
     * @dataProvider storeValidationProvider
     */
    public function test_create_new_lesson_validations($data)
    {
        $res = $this->call('POST', route('admin.syllabus.createNewLesson'), $data);

        $res_array = (array)json_decode($res->content());
        $this->assertArrayHasKey('errors', $res_array);
    }

    public function storeValidationProvider(): array
    {
        $this->refreshApplication();

        $group = $this->generateRandomGroup();
        $lesson = $this->generateRandomLesson();
        $student = $this->generateRandomStudent();

        return [
            "without data" => [
                [
                    'group_id' => null,
                    'lesson_id' => null,
                    'student_id' => null,
                    'from_chapter' => null,
                    'to_chapter' => null,
                    'from_page' => null,
                    'to_page' => null,
                ],
            ],
            "without a group_id" => [
                [
                    'group_id' => null,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => 1,
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => $lesson->from_page + 1,
                    'to_page' => $lesson->to_page - 1,
                ],
            ],
            "without a lesson_id" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => null,
                    'student_id' => $student->id,
                    'from_chapter' => 1,
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => $lesson->from_page + 1,
                    'to_page' => $lesson->to_page - 1,
                ],
            ],
            "without a student_id" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => null,
                    'from_chapter' => 1,
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => $lesson->from_page + 1,
                    'to_page' => $lesson->to_page - 1,
                ],
            ],
            "without from_chapter" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => null,
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => $lesson->from_page + 1,
                    'to_page' => $lesson->to_page - 1,
                ],
            ],
            "without to_chapter" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => 1,
                    'to_chapter' => null,
                    'from_page' => $lesson->from_page + 1,
                    'to_page' => $lesson->to_page - 1,
                ],
            ],
            "without from_page" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => 1,
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => null,
                    'to_page' => $lesson->to_page - 1,
                ],
            ],
            "without to_page" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => 1,
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => $lesson->from_page + 1,
                    'to_page' => null,
                ],
            ],
            "with from chapter not numeric" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => "a none numeric value",
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => $lesson->from_page + 1,
                    'to_page' => $lesson->to_page - 1,
                ],
            ],
            "with from chapter greater than total chapters" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => $lesson->chapters_count + 1,
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => $lesson->from_page + 1,
                    'to_page' => $lesson->to_page - 1,
                ],
            ],
            "with to chapter not numeric" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => 1,
                    'to_chapter' => "a none numeric value",
                    'from_page' => $lesson->from_page + 1,
                    'to_page' => $lesson->to_page - 1,
                ],
            ],
            "with to chapter greater than total chapters" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => 1,
                    'to_chapter' => $lesson->chapters_count + 1,
                    'from_page' => $lesson->from_page + 1,
                    'to_page' => $lesson->to_page - 1,
                ],
            ],
            "with to chapter less than from chapter" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => $lesson->chapters_count - 3,
                    'to_chapter' => $lesson->chapters_count - 4,
                    'from_page' => $lesson->from_page + 1,
                    'to_page' => $lesson->to_page - 1,
                ],
            ],
            "with from page not numeric" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => 1,
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => "a none numeric value",
                    'to_page' => $lesson->to_page - 1,
                ],
            ],
            "with from page less than lesson from page" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => 1,
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => $lesson->from_page - 1,
                    'to_page' => $lesson->to_page - 1,
                ],
            ],
            "with from page greater than lesson to page" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => 1,
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => $lesson->to_page + 1,
                    'to_page' => $lesson->to_page - 1,
                ],
            ],

            "with to page not numeric" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => 1,
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => $lesson->from_page + 1,
                    'to_page' => "a none numeric value",
                ],
            ],
            "with to page less than lesson from page" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => 1,
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => $lesson->from_page + 2,
                    'to_page' => $lesson->from_page + 1,
                ],
            ],
            "with to page greater than lesson to page" => [
                [
                    'group_id' => $group->id,
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                    'from_chapter' => 1,
                    'to_chapter' => $lesson->chapters_count - 1,
                    'from_page' => $lesson->from_page + 1,
                    'to_page' => $lesson->to_page + 1,
                ],
            ],
        ];
    }
}
