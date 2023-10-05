<?php

namespace App\Http\Controllers;

use App\Http\Requests\SyllabusReview\CreateNewLessonReviewRequest;
use App\Models\StudentLesson;
use App\Models\StudentLessonReview;
use App\Models\SyllabusReview;
use App\Services\StudentLesson\StudentLessonService;
use App\Services\StudentLessonReview\StudentLessonReviewService;
use App\Services\SyllabusReview\SyllabusReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SyllabusReviewController extends Controller
{
    private SyllabusReviewService   $syllabusReviewService;
    private StudentLessonService   $studentLessonService;
    private StudentLessonReviewService   $studentLessonReviewService;

    public function __construct(
        SyllabusReviewService $syllabusReviewService,
        StudentLessonService $studentLessonService,
        StudentLessonReviewService $studentLessonReviewService
    )
    {
        $this->syllabusReviewService = $syllabusReviewService;
        $this->studentLessonService = $studentLessonService;
        $this->studentLessonReviewService = $studentLessonReviewService;
    }

    public function createNewLessonAjax(CreateNewLessonReviewRequest $request)
    {
        $syllabusReview = DB::transaction(function () use ($request) {
            
            $studentLesson = $this->studentLessonService->firstOrCreateStudentLesson($request);

            $studentLessonReview = $this->studentLessonReviewService->firstOrCreateStudentLessonReview($studentLesson->id);

            return $this->syllabusReviewService->createSyllabusReview($request,$studentLessonReview->id);

        });

        return response()->json([
            'status' => 200,
            'syllabusReview' => $syllabusReview
        ]);
    }

    public function finishNewLessonReviewAjax(Request $request, SyllabusReview $syllabusReview)
    {
        if($syllabusReview->finished == true)
        {
            return response()->json([
                'status' => 400,
            ]);
        }

        if ($request->rate == "fail") {
            
            $this->syllabusReviewService->studentHasFaild($syllabusReview);
            
            $this->syllabusReviewService->createSyllabusReview((object) [
                'from_chapter' => $syllabusReview->from_chapter,
                'to_chapter' => $syllabusReview->to_chapter,
                'from_page' => $syllabusReview->from_page,
                'to_page' => $syllabusReview->to_page,
                'finished' => false
            ], $syllabusReview->student_lesson_review_id);

        } else {
            
            $this->syllabusReviewService->studentHasPassed($syllabusReview,$request->rate);
        }


        $studentLessonReview = $this->studentLessonReviewService->update($syllabusReview);

        return response()->json([
            'status' => 200,
            'studentLessonReview' => $studentLessonReview,
            'syllabusReview' => $syllabusReview
        ]);
    }
}
