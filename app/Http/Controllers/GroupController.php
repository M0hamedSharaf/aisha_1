<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\GroupDeleteRequest;
use App\Http\Requests\Group\GroupStoreRequest;
use App\Http\Requests\Group\GroupUpdateRequest;
use App\Http\Traits\TeacherTrait;
use App\Http\Traits\GroupTrait;
use App\Models\Group;
use RealRashid\SweetAlert\Facades\Alert;


class GroupController extends Controller
{
    use TeacherTrait;
    use GroupTrait;


    public function index()
    {
        $groups = $this->getGroupsDesc();

        return view('admin.pages.group.index', [
            'groups' => $groups
        ]);
    }

    public function create()
    {
        $teachers = $this->getTeachers();
        return view('admin.pages.group.create', [
            'teachers' => $teachers
        ]);
    }

    public function store(GroupStoreRequest $request)
    {
        Group::create([
            'teacher_id' => $request->teacher_id,
            'name' => $request->name,
            'type' => $request->type,
            'note' => $request->note,
        ]);

        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect(route('admin.group.index'));
    }

    public function edit(Group $group)
    {
        $teachers = $this->getTeachers();

        return view('admin.pages.group.edit', [
            'teachers' => $teachers,
            'group' => $group
        ]);
    }

    public function update(GroupUpdateRequest $request, Group $group)
    {

        $group->update([
            'teacher_id' => $request->teacher_id,
            'name' => $request->name,
            'type' => $request->type,
            'note' => $request->note,
        ]);

        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect(route('admin.group.index'));
    }

    public function delete(GroupDeleteRequest $request, Group $group)
    {

        $group->delete();

        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect(route('admin.group.index'));
    }
}
