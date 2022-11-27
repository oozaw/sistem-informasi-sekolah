<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class LoginController extends Controller {
    public function index() {
        return view('user.login', [
            "title" => "Login",
            "part" => ""
        ]);
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($request->username == 'admin') {
                $pegawaiNama = 'Administrator';
            } else {
                $user = User::where('username', $request->username)->first();
                $pegawaiNama = $user->pegawai->nama;
            }

            return redirect()->intended('/dashboard')->with('success', "Selamat datang $pegawaiNama");
        }

        return back()->with('fail', 'Login gagal, silahkan periksa kembali username dan password anda!');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}