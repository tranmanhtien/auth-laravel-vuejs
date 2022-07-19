<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class PasswordController extends Controller
{
    /**
     * Get template forgetpass
     * @return Illuminate\Contracts\View\View
     */
    public function forgetPassword() : View
    {
        return view('auth.forget_password');
    }

    /**
     * Update password
     * @param ResetPassword $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPassword $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if(empty($user)) {
            return response()->json([
                'errors' => 'Email does not exist!'
            ]);
        }
        $passwordReset = PasswordReset::where('email', $request->email)->first();
        $passwordResetFind = '';
        if(!empty($passwordReset)) {
            if(strtotime($passwordReset->expired_date) < strtotime(now())) {
                $passwordResetFind = $passwordReset->update([
                    'token' => Str::random(60),
                    'expired_date' => Carbon::now()->addMinutes(10),
                ]);
            }
        } else {
            $passwordResetFind = PasswordReset::create([
                'email' =>  $request->email,
                'token' => Str::random(60),
                'expired_date' => Carbon::now()->addMinutes(10),
            ]);
        }

        if ($passwordResetFind) {
            $user->notify(new ResetPasswordRequest($passwordReset->token,$request->email));
        }

        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }

    /**
     * Get view reset password
     * @return View
     */
    public function getResetPassword(): View
    {
        $token = '';
        $email = '';
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
        }

        if (isset($_GET['email'])) {
            $email = $_GET['email'];
        }

        return view('auth.reset_password', compact('token','email'));
    }

    /**
     * @param ChangePasswordRequest $request
     * @return JsonResponse|void
     */
    public function postResetPassword(ChangePasswordRequest $request)
    {
        $findResetPass = PasswordReset::where('email', $request->email_url)->where('token', $request->token_url)->where('expired_date', '>=', now())->first();
        if(empty($findResetPass)) {
            return response()->json([
                'status' => 401,
                'message' => 'Token expired'
            ]);
        }
        //update password if token not expired
        $user = User::where('email', $request->email_url)->first();
        if(empty($user)) {
            return response()->json([
                'status' => 401,
                'message' => 'Account not exist'
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password) ,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Update password success'
        ]);
    }
}
