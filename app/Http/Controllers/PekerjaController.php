<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use Illuminate\Http\Request;
use App\Http\Requests\StorePekerjaRequest;
use App\Http\Requests\UpdatePekerjaRequest;

class PekerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function create()
    {
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "nama" => "required",
            "email" => "required|email",
            "nip" => "unique:pekerja|nullable|numeric",
            "no_hp" => "required|unique:pekerja|numeric",
            "jabatan" => "required",
            "gender" => "required",
            "tempat_tinggal" => "required"
        ]);

        Pekerja::create($validatedData);

        // return redirect('/guru')->with('success', "Data pegawai baru, $request->nama berhasil ditambahkan!");
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
    public function show(Pekerja $pekerja)
    {
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
    public function edit(Pekerja $pekerja)
    {
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
    public function update(Request $request, Pekerja $pekerja)
    {
        $rules = [
            "nama" => "required",
            "email" => "required",
            "jabatan" => "required", 
            "gender" => "required",
            "tempat_tinggal" => "required"
        ];

        if ($request->nip != $pekerja->nip) {
            $rules['nip'] = "required|unique:pekerja";
        } else {
            $rulse['nip'] = "required";
        }
        
        if ($request->no_hp != $pekerja->no_hp) {
            $rules['no_hp'] = "required|unique:pekerja";
        } else {
            $rulse['no_hp'] = "required";
        }

        $validatedData = $request->validate($rules);

        Pekerja::where('id', $pekerja->id)->update($validatedData);
        
        if ($request->jabatan == "Guru") { 
            return redirect('/guru')->with("success", "Data $request->nama berhasil diperbarui!");
        } elseif ($request->jabatan == "Staf Tata Usaha") {
            return redirect('/tata-usaha')->with("success", "Data $request->nama berhasil diperbarui!");
        } else {
            return redirect('/pegawai-lain')->with("success", "Data $request->nama berhasil diperbarui!");            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pekerja  $pekerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pekerja $pekerja)
    {
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