<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Traits\AuthTrait;
use App\Jobs\AttachPermissionsToRoleJob;
use App\Models\Role;
use App\Services\Permission\PermissionService;
use App\Services\Role\RoleService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    private RoleService $roleService;
    private PermissionService $permissionService;

    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;

        $this->permissionService->handlePermissions($this,[
            'index' => 'index-role',
            'store' => 'store-role',
            'update' => 'update-role',
            'delete' => 'delete-role',
            'edit' => 'edit-role',
            'create' => 'create-role',
        ]);
    }

    public function index(RoleDataTable $roleDataTable)
    {
        return $roleDataTable->render('pages.role.index');
    }

    public function create()
    {
        return view('pages.role.create');
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = $this->roleService->createRole($request);

        $allPermissionsNames = $this->permissionService->getAllPermissionNames($request->permissions);

        AttachPermissionsToRoleJob::dispatch($allPermissionsNames, $role);

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect(route('admin.role.index'));
    }

    public function edit(Role $role): Factory|View|Application
    {
        $rolePermissions = $this->roleService->getRolePermissions($role);

        return view('pages.role.edit', [
            'role' => $role,
            'rolePermissions' => $rolePermissions->toArray(),
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $this->roleService->updateRole($request, $role);

        $allPermissionsNames = $this->permissionService->getAllPermissionNames($request->permissions);


        AttachPermissionsToRoleJob::dispatch($allPermissionsNames, $role);

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect(route('admin.role.index'));
    }

    public function delete(Role $role): RedirectResponse
    {
        $this->roleService->deleteRole($role);


        Alert::toast('تمت العملية بنجاح', 'success');
        return back();
    }

    public function getRoleUsers(Role $role)
    {
        return response()->json([
            'users' => $role->users()->select('id','name','email')->get(), 
            'teachers' => $role->teachers()->select('id','name','email')->get(), 
            'students' => $role->students()->select('id','name','email')->get(), 
        ]);
    }
}
