<?php


namespace App\Http\Traits;


use App\Models\User;

trait UserTrait
{
    private function getUsersDesc()
    {
        return User::orderBy('id', 'DESC')->get();
    }
}
