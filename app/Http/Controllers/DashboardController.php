<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pekerja;
use App\Models\Prestasi;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class DashboardController extends Controller {

    public function index() {
        return view('dashboard.index', [
            "title" => "Dashboard",
            "part" => "dashboard",
            "kelas" => Kelas::all(),
            "siswa" => Siswa::all(),
            "pekerjas" => Pekerja::all(),
            "surat_keluar" => SuratKeluar::all(),
            "surat_masuk" => SuratMasuk::all(),
            "tahun_ajaran" => TahunAjaran::all(),
            "prestasi" => Prestasi::all()
        ]);
    }

    public function baseURL() {
        return redirect('/dashboard');
    }

    public function getChartData(Request $request) {
        $tahunAjaran = TahunAjaran::all();
        $data = [];

        foreach ($tahunAjaran as $ta) {
            if ($ta->tahun_ajaran >= $request->awal && $ta->tahun_ajaran <= $request->akhir) {
                array_push($data, $ta);
            }
        }

        $collection = collect($data);
        // dd($collection);

        return view("dashboard.partials.chart", ['tahun_ajaran' => $collection]);
    }
}