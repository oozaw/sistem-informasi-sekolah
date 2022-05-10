<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class PrestasiController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('prestasi.index', [
            "title" => "Data Prestasi",
            "part" => "prestasi",
            "prestasi" => Prestasi::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('prestasi.tambah', [
            "title" => "Tambah Data Prestasi",
            "part" => "prestasi",
            "siswa" => Siswa::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            "nama" => "required",
            "jenis" => "required",
            "tingkat" => "required",
            "capaian" => "required",
            "tanggal" => "required",
            "bidang" => "required",
            "piagam" => "mimes:pdf|file|max:1000"
        ]);

        $carbon = new Carbon($request->tanggal);
        $validatedData["tanggal"] = $carbon->format('d M Y');
        $validatedData["tahun"] = $carbon->year;

        if ($request->file("piagam")) {
            $file_ext = $request->file('piagam')->getClientOriginalExtension();
            $nama_file = "$request->nama-$carbon->year-$request->capaian-$request->tingkat.$file_ext";
            $validatedData['piagam'] = $request->file('piagam')->storeAs('prestasi', $nama_file);
        }

        Prestasi::create($validatedData);

        return redirect('/prestasi')->with('success', "Data prestasi baru telah berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function show(Prestasi $prestasi) {
        return view('prestasi.detail', [
            "title" => "Detail Prestasi",
            "part" => "prestasi",
            "prestasi" => $prestasi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestasi $prestasi) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestasi $prestasi) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestasi $prestasi) {
        //
    }
}