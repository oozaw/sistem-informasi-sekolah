<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pekerja;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller {

    public function index() {
        // // get nama route sebelumnya
        // $url = url()->previous();
        // $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

        // // jika baru saja login maka reset config user
        // if ($route == 'login') {
        //     if (auth()->user()->username == 'admin') {
        //         $pegawaiNama = 'Administrator';
        //         $foto = 'null';
        //         $role = 'Admin';
        //     } else {
        //         $user = User::where('username', auth()->user()->username)->first();
        //         $pegawaiNama = $user->pegawai->nama;
        //         $foto = $user->pegawai->foto_profil;
        //         if ($user->role == 2) {
        //             $role = 'Guru';
        //         } elseif ($user->role == 3) {
        //             $role = 'Tata Usaha';
        //         } elseif ($user->role == 4) {
        //             $role = 'Kepala Sekolah';
        //         }
        //     }
        //     User::updateConfigUser($pegawaiNama, $role, $foto);
        // }

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

    public function baseURL() {
        return redirect('/dashboard');
    }
}