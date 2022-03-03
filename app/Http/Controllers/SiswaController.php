<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller {
    function index() {
        return view('siswa.index', [
            'title' => "Data Siswa",
            'part' => "siswa"
        ]);
    }
}