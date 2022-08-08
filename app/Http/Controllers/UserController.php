<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function index() {
        $user = auth()->user();
        return view('user.profile', [
            "title" => "Profil Pengguna",
            "part" => "",
            "user" => $user
        ]);
    }

    public function login() {
        return view('user.login', [
            "title" => "Login",
            "part" => ""
        ]);
    }
}