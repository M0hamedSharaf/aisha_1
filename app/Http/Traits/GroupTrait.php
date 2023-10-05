<?php


namespace App\Http\Traits;

use App\Models\Group;

trait GroupTrait
{
    private function getGroupsDesc()
    {
        return Group::orderBy('id', 'DESC')->get();
    }
    private function getGroups()
    {
        return Group::get();
    }
}
