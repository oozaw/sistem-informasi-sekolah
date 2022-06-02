<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Prestasi;
use App\Models\Perwakilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('siswa.index', [
            'title' => "Data Siswa",
            'part' => "siswa",
            'siswa' => Siswa::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('siswa.tambah', [
            "title" => "Tambah Siswa",
            "part" => "siswa",
            "kelas" => Kelas::all(),
            "prestasi" => Prestasi::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $validatedDataSiswa = $request->validate([
            "nama" => "required",
            "nis" => "required|unique:siswa|numeric",
            "nisn" => "required|unique:siswa|numeric",
            "gender" => "required",
            "no_telp" => "nullable|numeric|digits_between:12,14",
            "tempat_tinggal" => "required",
            "kelas_id" => "required",
            "foto_profil" => "nullable|image|max:10000"
        ]);

        if ($request->file("foto_profil")) {
            $file_ext = $request->file('foto_profil')->getClientOriginalExtension();
            $validatedData["foto_profil"] = $request->file("foto_profil")->storeAs("profil-siswa", "$request->nama.$file_ext");
        }

        if (!($request->no_telp)) {
            $validatedData["no_telp"] = "-";
        }

        $siswa = Siswa::create($validatedDataSiswa);

        $idSiswa = $siswa->id;

        // tambah prestasi siswa baru ke tabel perwakilan
        if ($request->option_prestasi == 'yes') {
            $dataPrestasi = ['siswa_id' => $idSiswa];
            for ($i = 1; $i <= $request->jumlah_prestasi; $i++) {
                $prestasi = "prestasi$i";
                $dataPrestasi['prestasi_id'] = $request->$prestasi;
                Perwakilan::create($dataPrestasi);
            }
        }

        return redirect('/siswa')->with("success", "Data siswa baru, $request->nama berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa) {
        $prestasi = Siswa::where('id', $siswa->id)->get()->flatMap->prestasi;

        return view('siswa.detail', [
            "title" => "Detail Siswa",
            "part" => "siswa",
            "siswa" => $siswa,
            "prestasi" => $prestasi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa) {
        $prestasiSiswa = Perwakilan::where('siswa_id', $siswa->id)->get();
        $jumlahPrestasi = count($prestasiSiswa);

        return view('siswa.edit', [
            "title" => "Edit Data Siswa",
            "part" => "siswa",
            "siswa" => $siswa,
            "kelas" => Kelas::all(),
            "prestasi" => Prestasi::all(),
            "prestasiSiswa" => $prestasiSiswa,
            "jumlahPrestasi" => $jumlahPrestasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa) {
        $rules = [
            "nama" => "required",
            "kelas_id" => "required",
            "gender" => "required",
            "tempat_tinggal" => "required",
            "foto_profil" => "nullable|image|max:10000"
        ];

        if ($request->nisn != $siswa->nisn) {
            $rules["nisn"] = "required|unique:siswa";
        } else {
            $rules["nisn"] = "required";
        }

        if ($request->no_telp != $siswa->no_telp) {
            $rules["no_telp"] = "nullable|unique:siswa";
        } else {
            $rules["no_telp"] = "nullable";
        }

        if ($request->nis != $siswa->nis) {
            $rules["nis"] = "required|unique:siswa";
        } else {
            $rules["nis"] = "required";
        }

        $validatedData = $request->validate($rules);

        if (!($request->no_telp)) {
            $validatedData["no_telp"] = "-";
        }

        if ($request->file("foto_profil")) {
            $file_ext = $request->file('foto_profil')->getClientOriginalExtension();
            Storage::delete("$request->nama.$file_ext");
            $validatedData["foto_profil"] = $request->file("foto_profil")->storeAs("profil-siswa", "$request->nama.$file_ext");
        }

        Siswa::where("id", $siswa->id)->update($validatedData);

        $prestasiSiswa = Perwakilan::where('siswa_id', $siswa->id)->get();
        $jumlahPrestasi = count($prestasiSiswa);
        $dataPrestasi = ['siswa_id' => $siswa->id];

        // untuk prestasi yang sudah ada sebelumnya
        for ($i = 1; $i <= $jumlahPrestasi; $i++) {
            $prestasi = "prestasi$i";
            if ($request->$prestasi == "kosong") {
                Perwakilan::destroy($prestasiSiswa[$i - 1]->id);
            } else {
                $dataPrestasi['prestasi_id'] = $request->$prestasi;
                Perwakilan::where("id", $prestasiSiswa[$i - 1]->id)->update($dataPrestasi);
            }
        }

        // untuk prestasi baru
        if ($request->option_prestasi == 'yes') {
            for ($i = 1; $i <= $request->jumlah_prestasi; $i++) {
                $counterPrestasiTotal = $i + $jumlahPrestasi;
                $prestasi = "prestasi$counterPrestasiTotal";
                $dataPrestasi['prestasi_id'] = $request->$prestasi;
                Perwakilan::create($dataPrestasi);
            }
        }

        return redirect("/siswa/$siswa->id")->with("success", "Data $siswa->nama berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa) {
        if ($siswa->foto_profil) {
            Storage::delete($siswa->foto_profil);
        }

        Siswa::destroy($siswa->id);

        return redirect("/siswa")->with("success", "Data $siswa->nama berhasil dihapus!");
    }
}