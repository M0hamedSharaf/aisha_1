<?php

namespace Tests\Controller;

use Carbon\Carbon;
use Tests\TestCaseWithTransLationsSetUp;
use Tests\Traits\TestExperienceTrait;
use Tests\Traits\TestTeacherTrait;

class ExperienceControllerTest extends TestCaseWithTransLationsSetUp
{
    use TestTeacherTrait;
    use TestExperienceTrait;

    protected function setUp(): void
    {
        parent::setUp();

        $this->refreshApplicationWithLocale('en');
    }

    public function test_index_opens_without_errors()
    {
        $res = $this->call('get', route('admin.experience.index'));

        $res->assertOk();
        $res->assertViewIs('pages.experience.index');
        $res->assertViewHas('teachers');
    }

    /**
     * @test
     * @dataProvider storeValidationProvider
     */
    public function test_store_validations($data)
    {
        $res = $this->call('POST', route('admin.experience.store'), $data);

        $res->assertSessionHasErrors();
    }

    public function test_store_pass_with_all_data()
    {
        $teacher = $this->generateRandomTeacher();
        $data = [
            'title' => 'this is title for exps',
            'from' => Carbon::now()->subDays(20)->toDateString(),
            'to' => Carbon::now()->subDays(10)->toDateString(),
            'teacher_id' => $teacher->id
        ];

        $res = $this->call('POST', route('admin.experience.store'), $data);

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseHas('experiences', $data);
    }

    /**
     * @dataProvider storeValidationProvider
     */
    public function test_update_validations($data)
    {
        $experience = $this->generateRandomExperience();

        $res = $this->call('PUT', route('admin.experience.update', $experience->id), $data);

        $res->assertSessionHasErrors();
    }

    public function test_update_works_with_all_data()
    {
        $experience = $this->generateRandomExperience();
        $teacher = $this->generateRandomTeacher();
        $data = [
            'title' => fake()->name(),
            'from' => Carbon::now()->subDays(20)->toDateString(),
            'to' => Carbon::now()->subDays(10)->toDateString(),
            'teacher_id' => $teacher->id
        ];

        $res = $this->call('PUT', route('admin.experience.update', $experience->id), $data);

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseHas('experiences', $data);
        $this->assertDatabaseMissing('experiences', [
            'title' => $experience->title,
            'from' => $experience->from,
            'to' => $experience->to,
            'teacher_id' => $experience->teacher_id,
        ]);
    }

    public function test_experience_get_deleted_without_errors()
    {
        $experience = $this->generateRandomExperience();

        $res = $this->call('get', route('admin.experience.delete', $experience->id));

        $res->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('experiences', [
            'id' => $experience->id,
            'title' => $experience->title,
            'from' => $experience->from,
            'to' => $experience->to,
            'teacher_id' => $experience->teacher_id,
        ]);
    }


    public function storeValidationProvider(): array
    {
        $this->refreshApplication();
        $teacher = $this->generateRandomTeacher();

        return [
            "without data" => [
                [],
            ],
            "without a title" => [
                [
                    'title' => null,
                    'from' => Carbon::now()->subDays(20)->toDateString(),
                    'to' => Carbon::now()->subDays(10)->toDateString(),
                    'teacher_id' => $teacher->id,
                ],
            ],
            "without a from" => [
                [
                    'title' => 'this is title for exps',
                    'from' => null,
                    'to' => Carbon::now()->subDays(10)->toDateString(),
                    'teacher_id' =>  $teacher->id
                ],
            ],
            "without a to" => [
                [
                    'title' => 'this is title for exps',
                    'from' => Carbon::now()->subDays(20)->toDateString(),
                    'to' => null,
                    'teacher_id' =>  $teacher->id
                ],
            ],
            "without teacher_id" => [
                [
                    'title' => 'this is title for exps',
                    'from' => Carbon::now()->subDays(20)->toDateString(),
                    'to' => Carbon::now()->subDays(10)->toDateString(),
                    'teacher_id' => null
                ],
            ],
            "with teacher that doesn't exist" => [
                [
                    'title' => 'this is title for exps',
                    'from' => Carbon::now()->subDays(20)->toDateString(),
                    'to' => Carbon::now()->subDays(10)->toDateString(),
                    'teacher_id' =>  intval($teacher->id + 1000)
                ],
            ],
            "if (from) is greater than (to)" => [
                [
                    'title' => 'this is title for exps',
                    'from' => Carbon::now()->subDays(10)->toDateString(),
                    'to' => Carbon::now()->subDays(12)->toDateString(),
                    'teacher_id' =>  $teacher->id
                ],
            ],
            "if (from) is grater than today" => [
                [
                    'title' => 'this is title for exps',
                    'from' => Carbon::now()->addDays(1)->toDateString(),
                    'to' => Carbon::now()->addDays(2)->toDateString(),
                    'teacher_id' =>  $teacher->id
                ],
            ],
            "if (to) is greater than today" => [
                [
                    'title' => 'this is title for exps',
                    'from' => Carbon::now()->subDays(10)->toDateString(),
                    'to' => Carbon::now()->addDays(2)->toDateString(),
                    'teacher_id' =>  $teacher->id
                ]
            ]

        ];
    }
}
