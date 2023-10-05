<?php

namespace Tests\Traits;

use App\Models\Group;
use App\Models\GroupStudent;
use App\Models\Student;
use Illuminate\Http\UploadedFile;

Trait TestStudentTrait
{
    private function generateRandomStudent($count = 1)
    {
        if ($count == 1) {
            $student = Student::factory()->create();
            $group = $this->generateRandomGroup();

            GroupStudent::factory()->create([
                'student_id' => $student->id,
                'group_id' => $group->id,
            ]);
            return $student;
        }
        $student = Student::factory($count)->create();

        $group = $this->generateRandomGroup();

        GroupStudent::factory()->create([
            'student_id' => $student->id,
            'group_id' => $group->id,
        ]);

        return $student;
    }

    private function generateRandomStudentData()
    {
        $password = fake()->password;

        return [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => $password,
            'password_confirmation' => $password,
            'birthday' => fake()->date(),
            'phone' => fake()->phoneNumber,
            'qualification' => fake()->text(),
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            'role' => fake()->randomElement(getSeededRoles())['name']
        ];
    }
}