<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attend\AttendDeleteRequest;
use App\Http\Requests\Attend\AttendStoreRequest;
use App\Http\Requests\Attend\AttendUpdateRequest;
use App\Http\Traits\AttendTrait;
use App\Http\Traits\LessonTrait;
use App\Http\Traits\StudentTrait;
use App\Models\Attend;
use RealRashid\SweetAlert\Facades\Alert;

class AttendController extends Controller
{
    use AttendTrait;
    use StudentTrait;
    use LessonTrait;

    public function index()
    {

        $attends = $this->getAttendsDesc();

        return view('admin.pages.attende.index', [
            'attends' => $attends
        ]);
    }

    public function create()
    {
        $students  = $this->getStudents();
        $lessons = $this->getLessons();

        return view('admin.pages.attende.create', [
            'students' => $students,
            'lessons' => $lessons

        ]);
    }

    public function store(AttendStoreRequest $request)
    {
        Attend::create([
            'student_id' => $request->student_id,
            'lesson_id' =>  $request->lesson_id,
            'date' =>  $request->date,
            'attend' =>  $request->attend == "" ? "0" : "1",
            'note' =>  $request->note,
        ]);
        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect()->back();
    }

    public function edit(Attend $attend)
    {
        $students  = $this->getStudents();
        $lessons = $this->getLessons();

        return view('admin.pages.attende.edit', [
            'students' => $students,
            'lessons' => $lessons,
            'attend' => $attend

        ]);
    }

    public function update(AttendUpdateRequest $request, Attend $attend)
    {
        $attend->update([
            'student_id' => $request->student_id,
            'lesson_id' =>  $request->lesson_id,
            'date' =>  $request->date,
            'attend' =>  $request->attend == "" ? "0" : "1",
            'note' =>  $request->note,
        ]);

        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect(route('admin.attend.index'));
    }

    public function delete(AttendDeleteRequest $request, Attend $attend)
    {


        $attend->delete();
        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect()->back();
    }
}
