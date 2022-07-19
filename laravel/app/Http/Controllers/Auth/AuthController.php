<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;

class AuthController extends Controller
{
    /**
     * Get form login
     * @return View
     */
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * Post form login
     * @param LoginRequest $request
     * @return string|void
     */
    public function postLogin(LoginRequest $request)
    {
        $dataCheck = [
          'email' => $request->email,
          'password' => $request->password,
        ];
        if (Auth::attempt($dataCheck)) {
            return redirect()->route('admin.dashboard');
        } else {
            return response()->json(
                [
                    'status' => 401,
                    'message' => 'Email or password not correct'
                ]
            );
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        User::create($request->all());
        return route('admin.dashboard');
    }
}
