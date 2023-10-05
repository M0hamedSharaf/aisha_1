<?php

namespace Tests\Controller;

use App\Services\StudentLesson\StudentLessonService;
use Mockery\MockInterface;
use Tests\TestCaseWithTransLationsSetUp;
use Tests\Traits\TestGroupStudentTrait;
use Tests\Traits\TestGroupTrait;
use Tests\Traits\TestGroupTypeTrait;
use Tests\Traits\TestLessonTrait;
use Tests\Traits\TestStudentLessonTrait;
use Tests\Traits\TestStudentTrait;
use Tests\Traits\TestSubjectTrait;
use Tests\Traits\TestTeacherTrait;

class StudentLessonControllerTest extends TestCaseWithTransLationsSetUp
{
    use TestStudentTrait;
    use TestGroupStudentTrait;
    use TestGroupTrait;
    use TestTeacherTrait;
    use TestGroupTypeTrait;
    use TestLessonTrait;
    use TestSubjectTrait;
    use TestStudentLessonTrait;

    public function setUp() : void
    {
        parent::setUp();
        
        $this->refreshApplicationWithLocale('en');
    }

    public function test_store_passes_with_all_data_if_shapter_is_finished()
    {
        $group = $this->generateRandomGroup();
        $lesson = $this->generateRandomLesson();
        $student = $this->generateRandomStudent();

        $data = [
            'group_id' => $group->id,
            'lesson_id' => $lesson->id,
            'student_id' => $student->id,
            "max_chapters" => $lesson->chapters_count,
            "chapters_count" => $lesson->chapters_count
        ];

        $this->mock(StudentLessonService::class, function (MockInterface $mock) {
            $mock->shouldReceive('isChapterFinished')->once()->andReturn(true);
            $mock->shouldReceive('finishStudentLesson')->once();
        });

        $res = $this->call('POST', route('admin.student_lesson.store'), $data);

        $res->assertSessionHasNoErrors();
        $res->assertRedirect();
    }

    public function test_store_passes_with_all_data_if_shapter_is_not_finished()
    {
        $group = $this->generateRandomGroup();
        $lesson = $this->generateRandomLesson();
        $student = $this->generateRandomStudent();

        $data = [
            'group_id' => $group->id,
            'lesson_id' => $lesson->id,
            'student_id' => $student->id,
            "max_chapters" => $lesson->chapters_count,
            "chapters_count" => $lesson->chapters_count - 1
        ];

        $this->mock(StudentLessonService::class, function (MockInterface $mock) {
            $mock->shouldReceive('isChapterFinished')->once()->andReturn(false);
            $mock->shouldReceive('store')->once();
        });

        $res = $this->call('POST', route('admin.student_lesson.store'), $data);

        $res->assertSessionHasNoErrors();
        $res->assertRedirect();
    }

    public function test_ajax_student_lesson_finished_pass_when_lesson_finished()
    {
        $this->mock(StudentLessonService::class, function (MockInterface $mock) {
            $mock->shouldReceive('finishStudentLesson')->once();
        });
        
        $res = $this->call('get', route('admin.student_lesson.ajaxStudentLessonFinished'), [
            'finished' => "true"
        ]);

        $res->assertJson([
            'status' => 200
        ]);
    }

    public function test_ajax_student_lesson_finished_pass_when_lesson_not_finished()
    {
        $this->mock(StudentLessonService::class, function (MockInterface $mock) {
            $mock->shouldReceive('unFinishStudentLesson')->once();
        });
        
        $res = $this->call('get', route('admin.student_lesson.ajaxStudentLessonFinished'), [
            'finished' => "false"
        ]);

        $res->assertJson([
            'status' => 200
        ]);
    }

    public function test_show_opens_successfully()
    {
        $studentLesson = $this->generateRandomStudentLesson();

        $res = $this->call('get', route('admin.student_lesson.show', $studentLesson->id), [
            'finished' => "false"
        ]);

        $res->assertOk();
    }
}