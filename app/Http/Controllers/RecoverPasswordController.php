<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class RecoverPasswordController extends Controller {
    //
    public function requestPassword() {
        return view('auth.forgot-password');
    }

    public function sendEmailRequestPassword(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function updatePassword(Request $request) {
        $request->validate([
                               'token'    => 'required',
                               'email'    => 'required|email',
                               'password' => 'required|min:8|confirmed',
                           ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function($user, $password) use ($request) {
                $user->forceFill([
                                     'password' => Hash::make($password),
                                 ])->save();

                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('platform.main')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
