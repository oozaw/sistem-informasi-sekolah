<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pekerja;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\TahunAjaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    function index() {
        $t = TahunAjaran::all()->sortBy('tahun_ajaran', SORT_REGULAR, true)->take(2)->sortBy('tahun_ajaran')->pluck('tahun_ajaran')->toArray();
        // dd($t);
        // dd(implode('","', $t));
        // dd(json_encode($t));
        return view('dashboard.index', [
            "title" => "Dashboard",
            "part" => "dashboard",
            "kelas" => Kelas::all(),
            "siswa" => Siswa::all(),
            "pekerjas" => Pekerja::all(),
            "surat_keluar" => SuratKeluar::all(),
            "surat_masuk" => SuratMasuk::all(),
            "tahun_ajaran" => TahunAjaran::all()
        ]);
    }
}