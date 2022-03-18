<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pekerja;
use App\Models\Siswa;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    function index() {
        return view('dashboard.index', [
            "title" => "Dashboard",
            "part" => "dashboard",
            "jumlah_kelas" => Kelas::all()->count(),
            "jumlah_siswa" => Siswa::all()->count(),
            "jumlah_laki" => Siswa::all()->where("gender", "Laki-laki")->count(),
            "jumlah_perempuan" => Siswa::all()->where("gender", "Perempuan")->count(),
            "jumlah_guru" => Pekerja::all()->where('jabatan', "Guru")->count(),
            "jumlah_tu" => Pekerja::all()->where('jabatan', "Staf Tata Usaha")->count(),
            "jumlah_staf_lain" => Pekerja::all()->where('jabatan', "Staf Lainnya")->count(),
            "jumlah_surat_keluar" => SuratKeluar::all()->count()
        ]);
    }
}