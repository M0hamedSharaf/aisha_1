<?php

namespace App\Jobs;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AttachPermissionsToRoleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $allPermissionsNames;
    private $role;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $allPermissionsNames, $role)
    {
        $this->allPermissionsNames = $allPermissionsNames;
        $this->role = $role;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $allPermissions = Permission::whereIn('name',$this->allPermissionsNames)->get();

        $this->role->attachPermissions($allPermissions);
    }
}
