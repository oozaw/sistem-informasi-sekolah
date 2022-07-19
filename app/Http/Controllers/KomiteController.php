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
     * @param  \App\Models\Komite  $komite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Komite $komite) {
        //
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
            return view('komite.partials.empty');
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