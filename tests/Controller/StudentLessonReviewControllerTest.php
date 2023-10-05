<?php

namespace Tests\Controller;

use App\Services\StudentLesson\StudentLessonService;
use App\Services\StudentLessonReview\StudentLessonReviewService;
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

class StudentLessonReviewControllerTest extends TestCaseWithTransLationsSetUp
{
    use TestStudentTrait;
    use TestGroupTrait;
    use TestGroupStudentTrait;
    use TestTeacherTrait;
    use TestGroupTypeTrait;
    use TestLessonTrait;
    use TestSubjectTrait;
    use TestStudentLessonTrait;

    protected function setUp() : void
    {
        parent::setUp();

        $this->refreshApplicationWithLocale('en');
    }

    public function test_ajax_student_lesson_finished_review_passes_if_lesson_is_finished()
    {
        $groupStudent = $this->generateRandomGroupStudent();
        $lesson = $this->generateRandomLesson();
        $studentLesson = $this->generateRandomStudentLesson();

        $this->mock(StudentLessonService::class, function (MockInterface $mock) use($studentLesson) {
            $mock->shouldReceive('firstOrCreateStudentLesson')->once()->andReturn($studentLesson);
        });

        $this->mock(StudentLessonReviewService::class, function (MockInterface $mock) {
            $mock->shouldReceive('finished')->once();
        });

        $res = $this->call('post',route('admin.student_lesson_review.ajaxStudentLessonFinishedReview'),[
            'chapters_count' => $lesson->chapters_count,
            "finished" => "true",
            "group_id" => $groupStudent->group_id,
            "last_page_finished" => $lesson->to_page,
            "lesson_id" => $lesson->id,
            "student_id" => $groupStudent->student_id
        ]);

        $res->assertJson([
            'status' => 200
        ]);
    }


    /**
     * @dataProvider ajaxStudentLessonFinishedValidationProvider
     */
    public function test_ajax_student_lesson_finished_validation_if_is_finished($data)
    {
        $this->mock(StudentLessonService::class, function (MockInterface $mock) {
            $mock->shouldReceive('firstOrCreateStudentLesson')->never();
        });

        $this->mock(StudentLessonReviewService::class, function (MockInterface $mock) {
            $mock->shouldReceive('finished')->never();
        });

        $res = $this->call('post',route('admin.student_lesson_review.ajaxStudentLessonFinishedReview'), $data);

        $res->assertSessionHasErrors();
    }

    
    public function test_ajax_student_lesson_finished_review_passes_if_lesson_is_not_finished()
    {
        $groupStudent = $this->generateRandomGroupStudent();
        $lesson = $this->generateRandomLesson();
        $studentLesson = $this->generateRandomStudentLesson();

        $this->mock(StudentLessonService::class, function (MockInterface $mock) use ($studentLesson) {
            $mock->shouldReceive('firstOrCreateStudentLesson')->once()->andReturn($studentLesson);
        });

        $this->mock(StudentLessonReviewService::class, function (MockInterface $mock) {
            $mock->shouldReceive('notFinished')->once();
        });

        $res = $this->call('post',route('admin.student_lesson_review.ajaxStudentLessonFinishedReview'),[
            'chapters_count' => $lesson->chapters_count,
            "finished" => "false",
            "group_id" => $groupStudent->group_id,
            "last_page_finished" => $lesson->to_page,
            "lesson_id" => $lesson->id,
            "student_id" => $groupStudent->student_id
        ]);

        $res->assertJson([
            'status' => 200
        ]);
    }


    /**
     * @dataProvider ajaxStudentLessonNotFinishedValidationProvider
     */
    public function test_ajax_student_lesson_finished_validation_if_is_not_finished($data)
    {
        $this->mock(StudentLessonService::class, function (MockInterface $mock) {
            $mock->shouldReceive('firstOrCreateStudentLesson')->never();
        });

        $this->mock(StudentLessonReviewService::class, function (MockInterface $mock) {
            $mock->shouldReceive('finished')->never();
        });

        $res = $this->call('post',route('admin.student_lesson_review.ajaxStudentLessonFinishedReview'), $data);

        $res->assertSessionHasErrors();
    }

    public function ajaxStudentLessonFinishedValidationProvider() : array
    {
        $this->refreshApplication();

        $group = $this->generateRandomGroup();
        $lesson = $this->generateRandomLesson();
        $student = $this->generateRandomStudent();

        return [
            "without data" => [
                [
                    
                ],
            ],
            "without a group_id" => [
                [
                    'group_id'           => null,
                    'lesson_id'          => $lesson->id,
                    'student_id'         => $student->id,
                    'finished'           => "true",
                    'chapters_count'     => $lesson->chapters_count,
                    'last_page_finished' => $lesson->to_page,
                ],
            ],
            "without a lesson_id" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => null,
                    'student_id'         => $student->id,
                    'finished'           => "true",
                    'chapters_count'     => $lesson->chapters_count,
                    'last_page_finished' => $lesson->to_page,
                ],
            ],
            "without a student_id" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => $lesson->id,
                    'student_id'         => null,
                    'finished'           => "true",
                    'chapters_count'     => $lesson->chapters_count,
                    'last_page_finished' => $lesson->to_page,
                ],
            ],
            "without a chapters_count" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => $lesson->id,
                    'student_id'         => $student->id,
                    'finished'           => "true",
                    'chapters_count'     => null,
                    'last_page_finished' => $lesson->to_page,
                ],
            ],
            "without a last_page_finished" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => $lesson->id,
                    'student_id'         => $student->id,
                    'finished'           => "true",
                    'chapters_count'     => $lesson->chapters_count,
                    'last_page_finished' => null,
                ],
            ],
            "with a group that doesn't exist" => [
                [
                    'group_id'           => intval($group->id + 1000),
                    'lesson_id'          => $lesson->id,
                    'student_id'         => $student->id,
                    'finished'           => "true",
                    'chapters_count'     => $lesson->chapters_count,
                    'last_page_finished' => $lesson->to_page,
                ],
            ],
            "with a lesson that doesn't exist" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => intval($lesson->id + 1000),
                    'student_id'         => $student->id,
                    'finished'           => "true",
                    'chapters_count'     => $lesson->chapters_count,
                    'last_page_finished' => $lesson->to_page,
                ],
            ],
            "without a student that doesn't exist" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => $lesson->id,
                    'student_id'         => intval($student->id + 1000),
                    'finished'           => "true",
                    'chapters_count'     => $lesson->chapters_count,
                    'last_page_finished' => $lesson->to_page,
                ],
            ],
            "with a chpaters count that is greater than lesson chapters count" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => $lesson->id,
                    'student_id'         => $student->id,
                    'finished'           => "true",
                    'chapters_count'     => $lesson->chapters_count + 1,
                    'last_page_finished' => $lesson->to_page,
                ],
            ],
            "with a chpaters count that is less than lesson chapters count" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => $lesson->id,
                    'student_id'         => $student->id,
                    'finished'           => "true",
                    'chapters_count'     => $lesson->chapters_count - 1,
                    'last_page_finished' => $lesson->to_page,
                ],
            ],
            "with a last_page_finished that is greater than lesson final page" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => $lesson->id,
                    'student_id'         => $student->id,
                    'finished'           => "true",
                    'chapters_count'     => $lesson->chapters_count,
                    'last_page_finished' => $lesson->to_page + 1,
                ],
            ],
            "with a last_page_finished that is less than lesson final page" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => $lesson->id,
                    'student_id'         => $student->id,
                    'finished'           => "true",
                    'chapters_count'     => $lesson->chapters_count,
                    'last_page_finished' => $lesson->to_page - 1,
                ],
            ],
        ];
    }

    public function ajaxStudentLessonNotFinishedValidationProvider() : array
    {
        $this->refreshApplication();

        $group = $this->generateRandomGroup();
        $lesson = $this->generateRandomLesson();
        $student = $this->generateRandomStudent();

        return [
            "without data" => [
                [
                    
                ],
            ],
            "without a group_id" => [
                [
                    'group_id'           => null,
                    'lesson_id'          => $lesson->id,
                    'student_id'         => $student->id,
                    'finished'           => "false",
                ],
            ],
            "without a lesson_id" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => null,
                    'student_id'         => $student->id,
                    'finished'           => "false",
                ],
            ],
            "without a student_id" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => $lesson->id,
                    'student_id'         => null,
                    'finished'           => "false",
                ],
            ],
            "with a group that doesn't exist" => [
                [
                    'group_id'           => intval($group->id + 1000),
                    'lesson_id'          => $lesson->id,
                    'student_id'         => $student->id,
                    'finished'           => "false",
                ],
            ],
            "with a lesson that doesn't exist" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => intval($lesson->id + 1000),
                    'student_id'         => $student->id,
                    'finished'           => "false",
                ],
            ],
            "without a student that doesn't exist" => [
                [
                    'group_id'           => $group->id,
                    'lesson_id'          => $lesson->id,
                    'student_id'         => intval($student->id + 1000),
                    'finished'           => "true",
                ],
            ],
        ];
    }
}