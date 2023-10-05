<?php

namespace App\Services\Role;

use App\Models\PermissionRole;
use App\Models\Role;

class RoleService
{
    /**
     * takes columns names and return roles
     * return collection of roles
     * @param array $selectColumns
     * @return Collection
     */
    public function getRoles(array $selectColumns = ['*'])
    {
        return Role::select($selectColumns)->get();
    }

    public function createRole($request): Role
    {
        return Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);
    }


    public function getRolePermissions($role)
    {
        return $role->permissions()->select('name')->get()->pluck('name');
    }

    public function updateRole($request, $role)
    {
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);

        $this->detachRolePermissions($role->id);
    }

    public function deleteRole($role): void
    {
        $this->detachRolePermissions($role->id);
        $role->delete();
    }

    public function detachRolePermissions($roleId)
    {
        PermissionRole::where('role_id', $roleId)->delete();
    }


}
