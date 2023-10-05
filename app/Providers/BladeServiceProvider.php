<?php

namespace App\Providers;

use App\Services\Permission\PermissionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('check_permission', function ($permission) {
            return in_array($permission, getPermissions());
        });

        Blade::if('check_permission_in_permissions', function (array $permissions) {
            foreach ($permissions as $permission) {
                if (in_array($permission, getPermissions())) {
                    return true;
                }
            }
            return false;
        });
    }
}
