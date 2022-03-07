<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function create()
    {
        return view('kelas.tambah', [
            "title" => "Tambah Kelas",
            "part" => "kelas"
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
           "nama" => "required|unique:kelas",
           "wali_kelas_id" => "required"
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
    public function show(Kelas $kela)
    {
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
    public function edit(Kelas $kela)
    {
        // dd($kela);
        return view('kelas.edit', [
            "title" => "Edit Kelas",
            "part" => "kelas",
            "kelas" => $kela
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas $kela
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kela)
    {
        $rules = [
            "wali_kelas_id" => "required"
        ];

        if (Str::lower($request->nama) != Str::lower($kela->nama)) {
            $rules["nama"] = "required|unique:kelas";
        } else {
            $rules["nama"] = "required";
        }

        $validatedData = $request->validate($rules);

        Kelas::where('id', $kela->id)->update($validatedData);

        return redirect('/kelas')->with('success', "Kelas $kela->nama berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas $kela
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kela)
    {
        Kelas::destroy($kela->id);

        return redirect('/kelas')->with('success', "Kelas $kela->nama berhasil dihapus!");
    }
}