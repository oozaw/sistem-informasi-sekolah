<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pekerja;
use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KelasController extends Controller {
    public function __construct() {
        // membatasi akses kepsek hanya ke method index dan show saja
        $this->middleware('is-kepsek')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('kelas.index', [
            "title" => "Data Kelas",
            "part" =>  "kelas",
            "kelas" => Kelas::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $wali_kelas_not_available = Kelas::all()->whereNotNull('wali_kelas_id')->pluck('wali_kelas_id');
        $wali_kelas_available = Pekerja::all()->where('jabatan', 'Guru')->whereNotIn('id', $wali_kelas_not_available)->all();

        return view('kelas.tambah', [
            "title" => "Tambah Kelas",
            "part" => "kelas",
            "wali_kelas" => $wali_kelas_available
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
            "nama" => "required|unique:kelas",
            "wali_kelas_id" => "required",
            "tingkatan" => "required"
        ]);

        Kelas::create($validatedData);

        return redirect("/kelas")->with("success", "Kelas baru, $request->nama berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas $kela
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kela) {
        return view('kelas.detail', [
            "title" => "Detail Kelas",
            "part" => "kelas",
            "kelas" => $kela,
            "siswa" => Siswa::all()->where('kelas_id', $kela->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas $kela
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kela) {
        $selected_wali_kelas = Kelas::all()->where('id', $kela->id)->pluck('wali_kelas_id');
        $wali_kelas_not_available = Kelas::all()->whereNotNull('wali_kelas_id')->whereNotIn('wali_kelas_id', $selected_wali_kelas)->pluck('wali_kelas_id');
        $wali_kelas_available = Pekerja::all()->where('jabatan', 'Guru')->whereNotIn('id', $wali_kelas_not_available)->all();
        // dd($wali_kelas_not_available, $wali_kelas_available);

        return view('kelas.edit', [
            "title" => "Edit Kelas",
            "part" => "kelas",
            "kelas" => $kela,
            "wali_kelas" => $wali_kelas_available
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas $kela
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kela) {
        $rules = [
            "wali_kelas_id" => "required",
            "tingkatan" => "required"
        ];

        if (Str::lower($request->nama) != Str::lower($kela->nama)) {
            $rules["nama"] = "required|unique:kelas";
        } else {
            $rules["nama"] = "required";
        }

        $validatedData = $request->validate($rules);

        Kelas::where('id', $kela->id)->update($validatedData);

        return redirect('/kelas')->with('success', "Kelas $kela->nama berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas $kela
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kela) {
        $jml_siswa = $kela->siswa()->get()->count();
        if ($jml_siswa != 0) {
            return redirect('/kelas')->with('fail', "Kelas berisi siswa tidak bisa dihapus!");
        } else {
            Kelas::destroy($kela->id);

            return redirect('/kelas')->with('success', "Kelas $kela->nama berhasil dihapus!");
        }
    }
}