<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Komite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KomiteController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tgl = new Carbon();
        $tgl->month <= 6 ? $semester = 1 : $semester = 2;
        $semester == 1 ? $bln_awal = 1 : $bln_awal = 7;

        return view('komite.index', [
            "title" => "Pembayaran Komite Siswa",
            "part" => "komite",
            "tgl" => $tgl,
            "kelas" => Kelas::all(),
            "semester" => $semester,
            "bln_awal" => $bln_awal,
            "komite" => Komite::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Komite  $komite
     * @return \Illuminate\Http\Response
     */
    public function show(Komite $komite) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Komite  $komite
     * @return \Illuminate\Http\Response
     */
    public function edit(Komite $komite) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $semester = $request->semester;
        $kelas_id = $request->kelas;

        $idSiswa = Siswa::getSiswaKelas($kelas_id)->pluck('id')->toArray();
        $semester == 'Ganjil' ? $bln_awal = 1 : $bln_awal = 7;
        $komite = Komite::whereIn('siswa_id', $idSiswa)->get();

        foreach ($komite as $k) {
            // index data
            $indexDaftarUlang = "daftar_ulang_$k->id";
            $indexKomiteS1 = "komite1_$k->id";

            // proses daftar ulang
            $daftarUlangDB = Komite::where("id", $k->id)->pluck('daftar_ulang')->first();
            $daftarUlang = $daftarUlangDB - $request->$indexDaftarUlang;

            $data = [
                "daftar_ulang" => $daftarUlang,
                "komite_1" => $request->$indexKomiteS1,
            ];

            // komite per bulan
            for ($i = $bln_awal; $i <= $bln_awal + 5; $i++) {
                $idRequest = 'komite_' . $k->id . '_' . $i;
                $data["$i"] = $request->$idRequest;
            }

            if (Komite::where('id', $k->id)->update($data)) {
                return response()->json([
                    "status" => 1,
                    "alert" => view("komite.partials.alert-success")->render(),
                ]);
            } else {
                return response()->json([
                    "status" => 0,
                    "alert" => view("komite.partials.alert-fail")->render(),
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Komite  $komite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Komite $komite) {
        //
    }

    public function getDataKomite(Request $request) {
        $siswa = Siswa::where('kelas_id', $request->kelas)->pluck('id')->toArray();
        $komite = Komite::whereIn('siswa_id', $siswa)->get();
        $request->semester == 'Ganjil' ? $bln_awal = 1 : $bln_awal = 7;

        if ($komite->count() == 0) {
            return response()->json([
                "status" => 0,
                "page" => view('komite.partials.empty')->render(),
                "message" => "gagal generate"
            ]);
        } else {
            $data = [
                "semester" => $request->semester,
                "komite" => $komite,
                "bln_awal" => $bln_awal
            ];

            return view('komite.partials.data', $data);
        }
    }

    public function updateKomite(Request $request) {
        $semester = $request->semester;
        $kelas_id = $request->kelas;

        $idSiswa = Siswa::getSiswaKelas($kelas_id)->pluck('id')->toArray();
        $semester == 'Ganjil' ? $bln_awal = 1 : $bln_awal = 7;
        $komite = Komite::whereIn('siswa_id', $idSiswa)->get();

        foreach ($komite as $k) {
            // index data
            $indexDaftarUlang = "daftar_ulang_$k->id";

            // proses daftar ulang
            if ($request->$indexDaftarUlang == "Lunas") {
                $daftarUlang = 0;
            } else {
                $daftarUlang = $request->$indexDaftarUlang;
            }

            $data = [
                "daftar_ulang" => $daftarUlang,
            ];

            // komite semester 1
            if ($semester == 'Ganjil') {
                $data["komite_1"] = "Lunas";
                for ($i = 1; $i <= 6; $i++) {
                    $idRequest = 'komite_' . $k->id . '_' . $i;
                    if ($request->$idRequest == "Belum Lunas") {
                        $data["komite_1"] = "Belum Lunas";
                        break;
                    }
                }
            }

            // komite per bulan
            for ($i = $bln_awal; $i <= $bln_awal + 5; $i++) {
                $idRequest = 'komite_' . $k->id . '_' . $i;
                $data["$i"] = $request->$idRequest;
            }

            DB::table('komite')->where('id', $k->id)->update($data);
        }

        return response()->json([
            "status" => 1,
            "alert" => view("komite.partials.alert-success")->render(),
        ]);
    }

    public function indexBebasKomite() {
        $tgl = new Carbon();
        $tgl->month <= 6 ? $semester = 1 : $semester = 2;
        $kelas_terdaftar = Siswa::all()->pluck('kelas_id')->toArray();
        $kelas_non_kosong = Kelas::whereIn('id', $kelas_terdaftar)->get()->sortBy('tingkatan');

        return view("komite.tambah-bebas-komite", [
            "title" => "Data Siswa Bebas Komite",
            "part" => "komite",
            "komite" => Komite::whereNotIn('bebas1', [0])->orWhereNotIn('bebas2', [0])->get(),
            "kelas" => $kelas_non_kosong,
            "tgl" => $tgl
        ]);
    }

    public function getDataSiswa(Request $request) {
        $kelasId = $request->kelas_id;
        $siswa = Siswa::where('kelas_id', $kelasId)->get()->sortBy('nama');

        return view("komite.partials.data-siswa", [
            "siswa" => $siswa
        ]);
    }

    public function updateBebasKomite(Request $request) {
        $siswaId = $request->siswa_id;
        $data = [
            "bebas1" => $request->bebas1,
            "bebas2" => $request->bebas2
        ];

        Komite::where('siswa_id', $siswaId)->update($data);

        return redirect('/bebas-komite')->with('success', "Data penerima beasiswa bebas komite berhasil disimpan!");
    }
}
