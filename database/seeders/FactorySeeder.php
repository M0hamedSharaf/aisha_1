<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\GroupDay;
use App\Models\Experience;
use App\Models\GroupStudent;
use App\Models\GroupSubject;
use App\Models\Payment;
use App\Models\StudentLesson;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Teacher::factory(2)->create()->each(function ($teacher) {
           Experience::factory(3)->create([
               'teacher_id' => $teacher->id
           ]);

           Group::factory(2)->create([
               'teacher_id' => $teacher->id,
               'group_type_id' => rand(1, 3)
           ])->each(function ($group) {

                for($i = 1; $i <= $group->groupType->days_num; $i++)
                {
                    $time = fake()->unique()->date('H:i');

                    GroupDay::factory()->create([
                        'group_id' => $group->id,
                        'day' => fake()->unique()->dayOfWeek,

                        'from_time' => $time,
                        'to_time' => date('H:i', strtotime("$time +1 hours")),
                    ]);
                }

                fake()->unique(true);



               Subject::factory(1)->create()->each(function ($subject) use ($group) {

                GroupSubject::factory()->create([
                    'group_id' => $group->id,
                    'subject_id' => $subject->id,
                ]);


                   Student::factory(5)->create()->each(function ($student) use ($subject, $group) {
                       $student->attachRole('student');
                       $lesson = Lesson::factory(1)->create([
                           'subject_id' => $subject->id
                       ])->each(function ($lesson) use ($student, $group) {
                           StudentLesson::factory(1)->create([
                               'lesson_id' => $lesson->id,
                               'student_id' => $student->id,
                               'group_id' => $group->id
                           ]);
                           Exam::factory(1)->create([
                               'student_id' => $student->id,
                               'group_id' => $group->id,
                               'lesson_from' => $lesson->id,
                               'lesson_to' => $lesson->id
                           ]);
                       });

                       GroupStudent::factory(1)->create([
                           'student_id' => $student->id,
                           'group_id' => $group->id
                       ]);

                       Payment::factory(2)->create([
                           'student_id' => $student->id,
                           'group_id' => $group->id,
                       ]);
                   });
               });
           });
       });
    }
}
