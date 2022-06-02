<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PekerjaController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('pekerja.index', [
            "title" => "Data Tenaga Kerja",
            "part" => "kepegawaian",
            "pegawai" => Pekerja::all()
        ]);
    }

    public function index_guru() {
        return view('pekerja.guru.index', [
            "title" => "Data Guru",
            "part" => "guru",
            "guru" => Pekerja::all()->where('jabatan', "Guru")
        ]);
    }

    public function index_tu() {
        return view('pekerja.tata-usaha.index', [
            "title" => "Data Staf Tata Usaha",
            "part" => "tu",
            "staf" => Pekerja::all()->where('jabatan', "Staf Tata Usaha")
        ]);
    }

    public function index_lain() {
        return view('pekerja.pegawai-lain.index', [
            "title" => "Data Staf Lain",
            "part" => "lainnya",
            "staf" => Pekerja::all()->where('jabatan', "Staf Lainnya")
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('pekerja.tambah', [
            "title" => "Tambah Data Tenaga Kerja",
            "part" => "kepegawaian",
            "guru" => Pekerja::all()->where('jabatan', "Guru")
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
            "email" => "required|email|unique:pekerja",
            "nip" => "unique:pekerja|nullable|numeric",
            "no_hp" => "required|unique:pekerja|numeric",
            "jabatan" => "required",
            "gender" => "required",
            "tempat_tinggal" => "required",
            "foto_profil" => "nullable|image|max:10000"
        ]);

        if ($request->file("foto_profil")) {
            $file_ext = $request->file('foto_profil')->getClientOriginalExtension();
            $validatedData["foto_profil"] = $request->file("foto_profil")->storeAs("profil-pekerja", "$request->nama.$file_ext");
        }

        if (!($request->nip)) {
            $validatedData["nip"] = "-";
        }

        Pekerja::create($validatedData);

        if ($request->jabatan == "Guru") {
            return redirect('/guru')->with('success', "Data pegawai baru, $request->nama berhasil ditambahkan!");
        } elseif ($request->jabatan == "Staf Tata Usaha") {
            return redirect('/tata-usaha')->with('success', "Data pegawai baru, $request->nama berhasil ditambahkan!");
        } elseif ($request->jabatan == "Staf Lainnya") {
            return redirect('/pegawai-lain')->with('success', "Data pegawai baru, $request->nama berhasil ditambahkan!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pekerja  $pekerja
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerja $pekerja) {
        return view('pekerja.detail', [
            "title" => "Detail Pegawai",
            "part" => "kepegawaian",
            "pekerja" => $pekerja
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pekerja  $pekerja
     * @return \Illuminate\Http\Response
     */
    public function edit(Pekerja $pekerja) {
        return view('pekerja.edit', [
            'title' => "Edit Data Pegawai",
            "part" => "kepegawaian",
            "pekerja" => $pekerja,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pekerja  $pekerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerja $pekerja) {
        $rules = [
            "nama" => "required",
            "jabatan" => "required",
            "gender" => "required",
            "tempat_tinggal" => "required",
            "foto_profil" => "nullable|mimes:jpg,png,gif,bmp,webp,svg|max:10000"
        ];

        if ($request->nip != $pekerja->nip) {
            $rules['nip'] = "nullable|unique:pekerja|numeric";
        } else {
            $rulse['nip'] = "nullable|numeric";
        }

        if ($request->email != $pekerja->email) {
            $rules['email'] = "required|email|unique:pekerja";
        } else {
            $rulse['email'] = "required";
        }

        if ($request->no_hp != $pekerja->no_hp) {
            $rules['no_hp'] = "required|unique:pekerja";
        } else {
            $rulse['no_hp'] = "required";
        }

        $validatedData = $request->validate($rules);

        if (!($request->nip)) {
            $validatedData["nip"] = "-";
        }

        if ($request->file("foto_profil")) {
            $file_ext = $request->file('foto_profil')->getClientOriginalExtension();
            Storage::delete("$request->nama.$file_ext");
            $validatedData["foto_profil"] = $request->file("foto_profil")->storeAs("profil-pekerja", "$request->nama.$file_ext");
        }

        Pekerja::where('id', $pekerja->id)->update($validatedData);

        return redirect("/pekerja/$pekerja->id")->with("success", "Data $request->nama berhasil diperbarui!");

        // if ($request->jabatan == "Guru") { 
        //     return redirect('/guru')->with("success", "Data $request->nama berhasil diperbarui!");
        // } elseif ($request->jabatan == "Staf Tata Usaha") {
        //     return redirect('/tata-usaha')->with("success", "Data $request->nama berhasil diperbarui!");
        // } else {
        //     return redirect('/pegawai-lain')->with("success", "Data $request->nama berhasil diperbarui!");            
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pekerja  $pekerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pekerja $pekerja) {
        if ($pekerja->foto_profil) {
            Storage::delete($pekerja->foto_profil);
        }

        Pekerja::destroy($pekerja->id);

        if ($pekerja->jabatan == "Guru") {
            return redirect('/guru')->with("success", "Data $pekerja->nama berhasil dihapus!");
        } elseif ($pekerja->jabatan == "Staf Tata Usaha") {
            return redirect('/tata-usaha')->with("success", "Data $pekerja->nama berhasil dihapus!");
        } else {
            return redirect('/pegawai-lain')->with("success", "Data $pekerja->nama berhasil dihapus!");
        }
    }
}