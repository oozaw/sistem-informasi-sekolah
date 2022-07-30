<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Komite;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        $rule = [
            "siswa_id" => "required",
            "daftar_ulang" => "required",
            "komite_1" => "required"
        ];

        if ($semester == 'Ganjil') {
            $rule = array_merge($rule, [
                "1" => "required",
                "2" => "required",
                "3" => "required",
                "4" => "required",
                "5" => "required",
                "6" => "required",
            ]);
        } else {
            $rule = array_merge($rule, [
                "7" => "required",
                "8" => "required",
                "9" => "required",
                "10" => "required",
                "11" => "required",
                "12" => "required"
            ]);
        }

        $validatedData = $request->validate($rule);

        foreach ($komite as $k) {
            // daftar ulang

            // komite per bulan
            for ($i = $bln_awal; $i <= $bln_awal + 5; $i++) {
                $idRequest = 'komite_' . $k->id . '_' . $i;
                $validatedData[$i] = $request->$idRequest;
            }
            Komite::where('id', $k->id)->update($validatedData);
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
}