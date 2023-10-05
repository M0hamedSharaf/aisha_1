<?php

namespace Tests\Services\Experience;

use App\Models\Experience;
use App\Services\Experience\ExperienceService;
use Carbon\Carbon;
use Tests\TestCase;
use Tests\Traits\TestExperienceTrait;
use Tests\Traits\TestTeacherTrait;

class ExperienceServiceTest extends TestCase
{

    use TestTeacherTrait;
    use TestExperienceTrait;


    public function test_create_experience()
    {
        $experienceObject = $this->app->make(ExperienceService::class);
        $teacher = $this->generateRandomTeacher();
        $data = (object)[
            'title' => fake()->name,
            'from' => Carbon::now()->subDays(20)->toDateString(),
            'to' => Carbon::now()->subDays(10)->toDateString(),
            'teacher_id' => $teacher->id
        ];

        $experienceObject->createExperience($data);

        $this->assertDatabaseHas('experiences', (array) $data);
    }

    public function test_update_experience()
    {
        $experienceObject = $this->app->make(ExperienceService::class);
        $experience = $this->generateRandomExperience();
        $data = (object)[
            'title' => fake()->name,
            'from' => Carbon::now()->subDays(20)->toDateString(),
            'to' => Carbon::now()->subDays(10)->toDateString(),
            'teacher_id' => $experience->teacher_id
        ];

        $experienceObject->updateExperience($experience, $data);

        $this->assertDatabaseHas('experiences', (array) $data);
    }


    public function test_delete_experience()
    {
        $experienceObject = $this->app->make(ExperienceService::class);
        $experience = $this->generateRandomExperience();

        $experienceObject->deleteExperience($experience);

        $this->assertDatabaseMissing('experiences', [
            'id' => $experience->id
        ]);
    }


    public function test_get_count_of_experience_years()
    {
        $experienceObject = $this->app->make(ExperienceService::class);

        $data = [

            (object)
            [
                "id"         => 1,
                "from"       => "2000-01-28",
                "to"         => "2005-11-22",
            ],
            (object)
            [
                "id"         => 2,
                "from"       => "2010-03-19",
                "to"         => "2015-08-09",
            ]
        ];

        $countYearsExperience = ($experienceObject->getCountOfExperienceYears($data));

        $this->assertEquals(11, $countYearsExperience);
    }
}
