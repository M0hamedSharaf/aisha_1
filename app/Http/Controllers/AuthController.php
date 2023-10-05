<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('admin.pages.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $cred = $request->only(['email','password']);

        if(Auth::attempt($cred))
        {
            Alert::success("نجاح تم الدخول");
            return redirect(route('admin.home'));
        }
        else
        {
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('admin.loginPage'));
    }
}
