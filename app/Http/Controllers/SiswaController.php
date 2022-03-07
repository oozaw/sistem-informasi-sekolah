<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function create()
    {
        return view('siswa.tambah', [
            "title" => "Tambah Siswa",
            "part" => "siswa",
            "kelas" => Kelas::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "nama" => "required",
            "nis" => "required|unique:siswa|numeric",
            "nisn" => "required|unique:siswa|numeric",
            "gender" => "required",
            "kelas_id" => "required"
        ]);

        Siswa::create($validatedData);

        return redirect('/siswa')->with("success", "Data siswa baru, $request->nama berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        return view('siswa.detail', [
            "title" => "Detail Siswa",
            "part" => "siswa",
            "siswa" => $siswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', [
            "title" => "Edit Data Siswa",
            "part" => "siswa",
            "siswa" => $siswa,
            "kelas" => Kelas::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $rules = [
            "nama" => "required",
            "kelas_id" => "required",
            "gender" => "required"
        ];

        if ($request->nisn != $siswa->nisn) {
            $rules["nisn"] = "required|unique:siswa";
        } else {
            $rules["nisn"] = "required"; 
        }

        if ($request->nis != $siswa->nis) {
            $rules["nis"] = "required|unique:siswa";
        } else {
            $rules["nis"] = "required";
        }

        $validatedData = $request->validate($rules);

        Siswa::where("id", $siswa->id)->update($validatedData);

        return redirect('/siswa')->with("success", "Data $siswa->nama berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        Siswa::destroy($siswa->id);

        return redirect("/siswa")->with("success", "Data $siswa->nama berhasil dihapus!");
    }
}