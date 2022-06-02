<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function index() {
        return view('user.profile', [
            "title" => "Profil Pengguna",
            "part" => ""
        ]);
    }

    public function login() {
        return view('user.login', [
            "title" => "Login",
            "part" => ""
        ]);
    }
}