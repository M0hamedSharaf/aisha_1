<?php

namespace App\Services\Permission;

use Illuminate\Support\Facades\Session;

class PermissionService
{

    public function getAllPermissionNames($requestPermissions): array
    {
        $allPermissionsNames = [];

        if (!is_null($requestPermissions)) {
            foreach ($requestPermissions as $table => $permissions) {
                foreach ($permissions as $permission) {
                    $allPermissionsNames[] = $permission;
                }
            }
        }

        return $allPermissionsNames;
    }

    public function setPermissionsSession($permissions)
    {
        Session::put('permissions', json_encode($permissions));
    }

    public function handlePermissions($controller, array $arr): void
    {
        foreach ($arr as $method => $permission) {
            $controller->middleware(function ($request, $next) use ($permission) {
                if (in_array($permission, getPermissions())) {
                    return $next($request);
                }
                abort(403);
            })->only($method);
        }
    }
}
