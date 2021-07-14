<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgotPassword() {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return response(["msg" => 'Reset password link sent on your email.']);
    }

    public function resetPassword(ForgotPasswordRequest $request) {
       /* $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);*/

        $reset_password_status = Password::reset($request->validated(), function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response(["msg" => "Invalid token provided"], 400);
        }

        return response(["msg" => "Password has been successfully changed"]);
    }
}