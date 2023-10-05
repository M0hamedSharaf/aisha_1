<?php

namespace App\Http\Controllers;

use App\DataTables\GroupStudentDataTable;
use App\Http\Requests\GroupStudent\StoreGroupStudentRequest;
use App\Models\Group;
use App\Models\GroupStudent;
use App\Models\Student;
use App\Services\GroupStudent\GroupStudentService;
use App\Services\Permission\PermissionService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GroupStudentController extends Controller
{
    private GroupStudentService $groupStudentService;
    private PermissionService $permissionService;

    public function __construct(
        GroupStudentService $groupStudentService,
        PermissionService $permissionService
    ) {
        $this->groupStudentService = $groupStudentService;
        $this->permissionService = $permissionService;


        $this->permissionService->handlePermissions($this, [
            'index' => 'index-groupStudent',
            'store' => 'store-groupStudent',
            'delete' => 'delete-groupStudent',
        ]);
    }

    public function index(GroupStudentDataTable $GroupStudentDataTable)
    {
        $groups = Group::groups()->select(['id', 'name'])->get();
        $students = Student::students()->select(['id', 'name'])->get();
        return $GroupStudentDataTable->render('pages.groupStudent.index', [
            'groups' => $groups,
            'students' => $students,
        ]);
    }

    public function store(StoreGroupStudentRequest $request)
    {
        $this->groupStudentService->createGroupStudent($request);

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }

    public function delete(GroupStudent $groupStudent)
    {
        $this->groupStudentService->deleteGroupStudent($groupStudent);

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }

    public function getGroupStudents(Request $request)
    {
        return response()->json([
            'groupStudents' => $this->groupStudentService->getGroupStudentsOfGroup($request->group_id)
        ]);
    }

    public function getStudentGroups(Request $request)
    {
        return response()->json([
            'studentGroups' => $this->groupStudentService->getGroupStudentsOfStudent($request->student_id)
        ]);
    }
}
