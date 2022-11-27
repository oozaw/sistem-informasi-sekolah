<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller {
    public function index() {
        return view('user.forgot_password', [
            'title' => "Lupa Kata Sandi",
            'part' => ""
        ]);
    }

    public function sendLink(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }

    public function indexResetPassword(Request $request) {
        return view('user.reset_password', [
            'request' => $request,
            'title' => "Atur Ulang Kata Sandi",
            'part' => ""
        ]);
    }

    public function submitNewPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'dec_password' => encrypt($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))->with('success', 'Kata sandi berhasil diubah, silahkan login')
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}