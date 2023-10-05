<?php


namespace App\Http\Traits;

use App\Models\Attend;

trait AttendTrait
{
    private function getAttendsDesc()
    {
        return Attend::orderBy('id', 'DESC')->get();
    }
}
