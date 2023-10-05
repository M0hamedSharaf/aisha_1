<?php

namespace App\Http\Controllers;

use App\Http\Requests\Exam\ExamDeleteRequest;
use App\Http\Requests\Exam\ExamStoreRequest;
use App\Http\Requests\Exam\ExamUpdateRequest;
use App\Http\Traits\ExamTrait;
use App\Http\Traits\TeacherTrait;
use App\Models\Exam;
use App\Models\Teacher;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Traits\ExamTrait;
use App\Http\Traits\TeacherTrait;

class ExamController extends Controller
{
<<<<<<< HEAD
    use ExamTrait;
    use TeacherTrait;
    public function index()
    {
        $exams = $this->getExamDesc();
=======
use ExamTrait;
use TeacherTrait;



    public function index()
    {
        $exams = $this->getExamsDesc();
>>>>>>> 0594cf6fcacf0275a178a147de0de9c81dd630df
        return view('admin.pages.exam.index', [
            'exams' => $exams
        ]);
    }

    public function create()
    {
<<<<<<< HEAD
        $teachers = $this->getTeachers();
=======
        $teachers = $this-> getTeachers();
>>>>>>> 0594cf6fcacf0275a178a147de0de9c81dd630df
        return view('admin.pages.exam.create', [
            'teachers' => $teachers
        ]);
    }

    public function store(ExamStoreRequest $request)
    {

        Exam::create([
            'teacher' => $request->teacher_name,
            'title' => $request->title,
            'max_mark' => $request->max_mark,
            'min_mark' => $request->min_mark,
            'note' => $request->note,
        ]);
        Alert::success('نجاح', 'تمت العملية بنجاح');

        return redirect(route('admin.exam.index'));
    }

    public function edit(Exam $exam)
    {
<<<<<<< HEAD

=======
       
>>>>>>> 0594cf6fcacf0275a178a147de0de9c81dd630df
        $teachers = $this->getTeachers();
        return view('admin.pages.exam.edit', [
            'teachers' => $teachers,
            'exam' => $exam
        ]);
    }

    public function update(ExamUpdateRequest $request , Exam $exam)
    {

        $exam->update([
            'teacher' => $request->teacher_name,
            'title' => $request->title,
            'max_mark' => $request->max_mark,
            'min_mark' => $request->min_mark,
            'note' => $request->note,
        ]);
        Alert::success('نجاح', 'تمت العملية بنجاح');

        return redirect(route('admin.exam.index'));
    }

    public function delete(ExamDeleteRequest $request , Exam $exam)
    {



        $exam->delete();
        Alert::success('نجاح', 'تمت العملية بنجاح');

        return redirect()->back();
    }
}
