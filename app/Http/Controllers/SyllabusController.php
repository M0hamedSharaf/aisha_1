<?php

namespace App\Http\Controllers;

use App\Http\Requests\syllabus\CreateNewLessonRequest;
use App\Http\Traits\AuthTrait;
use App\Models\Group;
use App\Models\Student;
use App\Models\syllabus;
use App\Services\StudentLesson\StudentLessonService;
use App\Services\Syllabus\SyllabusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SyllabusController extends Controller
{

    private StudentLessonService $studentLessonService;
    private SyllabusService   $syllabusService;

    public function __construct(
        StudentLessonService $studentLessonService,
        SyllabusService      $syllabusService
    ) {
        $this->studentLessonService = $studentLessonService;
        $this->syllabusService      = $syllabusService;
    }

    public function createNewLesson(CreateNewLessonRequest $request)
    {
        $student_lesson_id = $request->student_lesson_id;


        if (!$request->student_lesson_id) {
            $studentLesson = $this->studentLessonService->firstOrCreateStudentLesson($request);
            $student_lesson_id = $studentLesson->id;
        }

        if ($this->syllabusService->checkIfStudentLessonNotFinished($student_lesson_id)) {
            return response()->json([
                'status' => 400,
            ]);
        }

        $syllabi = $this->syllabusService->createSyllabus($request, $student_lesson_id);

        return response()->json([
            'status' => 200,
            'syllabi' => $syllabi
        ]);
    }

    public function finishNewLessonAjax(Request $request, syllabus $syllabus)
    {
        if ($syllabus->finished == true) {
            return response()->json([
                'status' => 400,
            ]);
        }

        if ($request->rate == "fail") {

            DB::transaction(function () use ($request, $syllabus) {
                $this->syllabusService
                    ->updateSyllabusFinished($request, $syllabus);

                $this->syllabusService
                    ->createSyllabus(
                        (object)[
                            'from_chapter' => $syllabus->from_chapter,
                            'to_chapter' => $syllabus->to_chapter,
                            'from_page' => $syllabus->from_page,
                            'to_page' => $syllabus->to_page,
                        ],
                        $syllabus->student_lesson_id
                    );
            });
        } else {
            $this->syllabusService
                ->updateSyllabusFinished($request, $syllabus);
        }

        $studentLesson = $this->syllabusService->finishNewLesson($syllabus);

        return response()->json([
            'status' => 200,
            'studentLesson' => $studentLesson,
            'syllabus' => $syllabus
        ]);
    }

    public function getStudentUnfinishedSyllabus(Student $student, Group $group)
    {
        $studentLessons = $student->studentLessons()
            ->where('group_id', $group->id)
            ->with([
                'syllabus' => function ($q) {
                    return $q->where('finished', false)->with('studentLesson.lesson');
                }
            ])
            ->get();

        $syllabus = [];

        foreach ($studentLessons as $studentLesson) {
            foreach ($studentLesson->syllabus as $syllabi) {
                if ($syllabi->finished == false) {
                    $syllabus[] = $syllabi;
                }
            }
        }

        return response()->json([
            'status' => 200,
            'syllabus' => $syllabus
        ]);
    }
}
