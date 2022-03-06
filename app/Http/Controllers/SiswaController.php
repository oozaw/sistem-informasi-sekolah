<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller {
    function index() {
        return view('siswa.index', [
            'title' => "Data Siswa",
            'part' => "siswa",
            'siswa' => Siswa::all()
        ]);
    }
}