<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        if(Auth::attempt($request->all())) {
            return route();
        }

        return 0;
//        dd($request->all());
    }
}
