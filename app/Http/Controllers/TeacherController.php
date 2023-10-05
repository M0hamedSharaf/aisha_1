<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teacher\TeacherDeleteRequest;
use App\Http\Requests\Teacher\TeacherStoreRequest;
use App\Http\Requests\Teacher\TeacherUpdateRequest;
use App\Http\Traits\TeacherTrait;
use App\Models\Teacher;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherController extends Controller
{

    use TeacherTrait;

    public function index()
    {
        $teachers = $this->getTeachersDesc();

        return view('admin.pages.teacher.index', [
            'teachers' => $teachers,
        ]);
    }

    public function create()
    {
        return view('admin.pages.teacher.create');
    }

    public function store(TeacherStoreRequest $request)
    {
        Teacher::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'note' => $request->note,
        ]);
        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect(route('admin.teacher.index'));
    }

    public function edit(Teacher $teacher)
    {  
        return view('admin.pages.teacher.edit', [
            'teacher'  => $teacher,
        ]);
    }

    public function update(TeacherUpdateRequest $request, Teacher $teacher)
    {
        $teacher->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'note' => $request->note,
        ]);


        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect(route('admin.teacher.index'));
    }

    public function delete(TeacherDeleteRequest $request, Teacher $teacher)
    {

        $teacher->delete();

        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect()->back();
    }
}
