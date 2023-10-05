<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentLesson\StoreStudentLessonRequest;
use App\Http\Traits\AuthTrait;
use App\Models\StudentLesson;
use App\Services\Permission\PermissionService;
use App\Services\StudentLesson\StudentLessonService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StudentLessonController extends Controller
{
    private StudentLessonService $studentLessonService;
    private PermissionService $permissionService;

    public function __construct(
        StudentLessonService $studentLessonService,
        PermissionService $permissionService
        )
    {
        $this->studentLessonService = $studentLessonService;
        $this->permissionService = $permissionService;

       $this->permissionService->handlePermissions($this,[
            'show' => 'show-studentLesson',
            'store' => 'store-studentLesson',
        ]);
    }

    public function store(StoreStudentLessonRequest $request)
    {
        if ($this->studentLessonService->isChapterFinished($request)) {
            $this->studentLessonService->finishStudentLesson($request);
        } else {
            $this->studentLessonService->store($request);
        }

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }

    public function ajaxStudentLessonFinished(Request $request)
    {
        if ($request->finished == "true") {
            $this->studentLessonService->finishStudentLesson($request);
        } else {
            $this->studentLessonService->unFinishStudentLesson($request);
        }

        return response()->json([
            'status' => 200
        ]);
    }

    public function show(StudentLesson $studentLesson): Factory|View|Application
    {
        $studentLessonReview = $this->studentLessonService->getStudentLessonReview($studentLesson);

        return view('pages.studentLesson.show', [
            'studentLesson' => $studentLesson,
            'studentLessonReview' => $studentLessonReview
        ]);
    }


}
