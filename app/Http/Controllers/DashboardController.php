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

        // $test = TahunAjaran::where('id', 1)->first()->tahun_ajaran;
        // dd($test  >= '2019/2020');

        // $tahunAjaran = TahunAjaran::all();
        // $data = [];

        // foreach ($tahunAjaran as $ta) {
        //     if ($ta->tahun_ajaran >= '2020/2021' && $ta->tahun_ajaran <= '2022/2023') {
        //         array_push($data, $ta);
        //     }
        // }

        // $collection = collect($data);

        // $test = $collection->sortBy('tahun_ajaran', SORT_REGULAR, true)->take(5)->sortBy('tahun_ajaran');
        // dd($ta);

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