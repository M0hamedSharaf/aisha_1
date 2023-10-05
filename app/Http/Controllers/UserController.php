<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\UserDeleteRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Traits\UserTrait;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use UserTrait;
    public function index()
    {
        $users = $this->getUsersDesc();
        return view('admin.pages.user.index', [
            "users" => $users
        ]);
    }

    public function create()
    {
        return view('admin.pages.user.create');
    }

    public function store(UserStoreRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect(route("admin.user.index"));
    }

    public function edit(User $user)
    {

        return view('admin.pages.user.edit', [
            "user" => $user
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]

        );
        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect(route("admin.user.index"));
    }

    public function delete(UserDeleteRequest $request, User $user)
    {


        $user->delete();
        Alert::success('نجاح', 'تمت العملية بنجاح');
        return redirect(route("admin.user.index"));
    }
}
