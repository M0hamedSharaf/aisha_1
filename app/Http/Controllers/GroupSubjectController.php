<?php

namespace App\Http\Controllers;

use App\DataTables\GroupSubjectDataTable;
use App\Http\Requests\GroupSubject\StoreGroupSubjectRequest;
use App\Models\Group;
use App\Models\GroupSubject;
use App\Models\Subject;
use App\Services\GroupSubject\GroupSubjectService;
use App\Services\Permission\PermissionService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GroupSubjectController extends Controller
{
    private GroupSubjectService $groupSubjectService;
    private PermissionService   $permissionService;

    public function __construct(
        GroupSubjectService $groupSubjectService,
        PermissionService   $permissionService
    ) {
        $this->groupSubjectService = $groupSubjectService;
        $this->permissionService = $permissionService;


        $this->permissionService->handlePermissions($this, [
            'index' => 'index-groupSubject',
            'store' => 'store-groupSubject',
            'delete' => 'delete-groupSubject',
        ]);
    }

    public function index(GroupSubjectDataTable $GroupSubjectDataTable)
    {
        $groups = Group::groups()->select(['id', 'name'])->get();
        $subjects = Subject::select(['id', 'name'])->get();
        return $GroupSubjectDataTable->render('pages.groupSubject.index', [
            'groups' => $groups,
            'subjects' => $subjects,
        ]);
    }

    public function store(StoreGroupSubjectRequest $request)
    {
        $this->groupSubjectService->createGroupSubject($request);

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }

    public function delete(GroupSubject $groupSubject)
    {
        $this->groupSubjectService->deleteGroupSubject($groupSubject);

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }

    public function getGroupSubjects(Request $request)
    {
        return response()->json([
            'groupSubjects' => $this->groupSubjectService->getGroupSubjectsOfGroup($request->group_id)
        ]);
    }
}
