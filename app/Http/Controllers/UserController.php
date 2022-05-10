<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function index() {
        return view('user.profile', [
            "title" => "Profil Pengguna",
            "part" => ""
        ]);
    }

    function login() {
        return view('user.login', [
            "title" => "Login",
            "part" => ""
        ]);
    }
}