<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    function index() {
        return view('dashboard.index', [
            "title" => "Dashboard",
            "part" => "dashboard",
            "jumlah_kelas" => Kelas::all()->count(),
            "jumlah_siswa" => Siswa::all()->count()
        ]);
    }
}