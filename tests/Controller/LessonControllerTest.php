<?php

namespace Tests\Controller;

use Tests\TestCaseWithTransLationsSetUp;
use Tests\Traits\TestLessonTrait;
use Tests\Traits\TestSubjectTrait;

class LessonControllerTest extends TestCaseWithTransLationsSetUp
{

    use TestLessonTrait;
    use TestSubjectTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshApplicationWithLocale('en');
    }


    public function test_index_opens_without_errors()
    {
        $res = $this->call('get', route('admin.lesson.index'));

        $res->assertOk();
        $res->assertViewIs('pages.lesson.index');
        $res->assertViewHas('subjects');
    }

    /**
     * @test
     * @dataProvider storeValidationProvider
     */
    public function test_store_validations($data)
    {
        $res = $this->call('POST', route('admin.lesson.store'), $data);

        $res->assertSessionHasErrors();
    }

    public function test_store_pass_with_all_data()
    {
        $data = $this->generateRandomLessonData();

        $res = $this->call('POST', route('admin.lesson.store'), $data);

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseHas('lessons', $data);
    }

    /**
     * @dataProvider storeValidationProvider
     */
    public function test_update_validations($data)
    {
        $lesson = $this->generateRandomLesson();

        $res = $this->call('PUT', route('admin.lesson.update', $lesson->id), $data);

        $res->assertSessionHasErrors();
    }

    public function test_update_works_with_all_data()
    {
        $lesson = $this->generateRandomLesson();
        $data = $this->generateRandomLessonData();

        $res = $this->call('PUT', route('admin.lesson.update', $lesson->id), $data);

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseHas('lessons', $data);
        $this->assertDatabaseMissing('lessons', [
            'subject_id' => $lesson->subject_id,
            'title' => $lesson->title,
            'from_page' => $lesson->from_page,
            'to_page' => $lesson->to_page,
            'chapters_count' => $lesson->chapters_count,
        ]);
    }

    public function test_group_type_get_deleted_without_errors()
    {
        $lesson = $this->generateRandomLesson();

        $res = $this->call('get', route('admin.lesson.delete', $lesson->id));

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('lessons', [
            'id' => $lesson->id
        ]);
    }


    public function storeValidationProvider(): array
    {
        $this->refreshApplication();
        $subject = $this->generateRandomSubject();

        return [
            "without data" => [
                [],
            ],
            "without a group_id" => [
                [
                    'subject_id' => null,
                    'title' => fake()->name(),
                    'from_page' => 10,
                    'to_page' => 20,
                    'chapters_count' => 30,
                ],
            ],
            "without a title" => [
                [
                    'subject_id' => $subject->id,
                    'title' => null,
                    'from_page' => 10,
                    'to_page' => 20,
                    'chapters_count' => 30,
                ],
            ],
            "without a from page" => [
                [
                    'subject_id' => $subject->id,
                    'title' => fake()->name(),
                    'from_page' => null,
                    'to_page' => 20,
                    'chapters_count' => 30,
                ],
            ],
            "without a to page" => [
                [
                    'subject_id' => $subject->id,
                    'title' => fake()->name(),
                    'from_page' => 10,
                    'to_page' => null,
                    'chapters_count' => 30,
                ],
            ],
            "without a chapters count" => [
                [
                    'subject_id' => $subject->id,
                    'title' => fake()->name(),
                    'from_page' => 10,
                    'to_page' => 20,
                    'chapters_count' => null,
                ],
            ],
            "with a subject that doesn't exist" => [
                [
                    'subject_id' => intval($subject->id + 100),
                    'title' => fake()->name(),
                    'from_page' => 10,
                    'to_page' => 20,
                    'chapters_count' => 30,
                ],
            ],
            "with a from page greater than to page" => [
                [
                    'subject_id' => $subject->id,
                    'title' => fake()->name(),
                    'from_page' => 20,
                    'to_page' => 10,
                    'chapters_count' => 30,
                ],
            ],
        ];
    }
}
