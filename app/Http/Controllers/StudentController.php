<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StudentDeleteRequest;
use App\Http\Requests\Student\StudentStoreRequest;
use App\Http\Requests\Student\StudentUpdateRequest;
use App\Http\Traits\GroupTrait;
use App\Http\Traits\StudentTrait;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{

    use GroupTrait;
    use StudentTrait;

    public function index()
    {
        $students  = $this->getStudentsDesc();

        return view('admin.pages.student.index', [
            'students' => $students,
        ]);
    }

    public function create()
    {
        $groups = $this->getGroups();

        return view('admin.pages.student.create', [
            'groups' => $groups
        ]);
    }

    public function store(StudentStoreRequest $request)
    {
    
        Student::create([
            'name' => $request->name,
            'brithday' => $request->brithday,
            'phone' => $request->phone,
            'type' => $request->type,
            'group_id' => $request->group_id,
            'note' => $request->note,
        ]);
        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect(route('admin.student.index'));
    }

    public function edit(Student $student)
    {
        $groups = $this->getGroups();
        
        return view('admin.pages.student.edit', [
            'groups' => $groups,
            'student' => $student
        ]);
    }

    public function update(StudentUpdateRequest $request ,Student $student)
    {
        $student->update([
            'name' => $request->name,
            'brithday' => $request->brithday,
            'phone' => $request->phone,
            'type' => $request->type,
            'group_id' => $request->group_id,
            'note' => $request->note,
        ]);

        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect(route('admin.student.index'));
    }

    public function delete(StudentDeleteRequest $request ,Student $student)
    {
        $student->delete();

        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect()->back();
    }
}
