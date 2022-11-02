<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\PekerjaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PekerjaController extends Controller {
    public function __construct() {
        // membatasi akses kepsek hanya ke method index dan show saja
        $this->middleware('is-kepsek')->except(['index', 'indexGuru', 'indexTu', 'indexLain', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('pekerja.index', [
            "title" => "Data Pegawai",
            "part" => "pegawai",
            "pegawai" => Pekerja::all()->sortBy('nama')
        ]);
    }

    public function indexGuru() {
        return view('pekerja.guru.index', [
            "title" => "Data Guru",
            "part" => "guru",
            "guru" => Pekerja::all()->where('jabatan', "Guru")->sortBy('nama')
        ]);
    }

    public function indexTu() {
        return view('pekerja.tata-usaha.index', [
            "title" => "Data Staf Tata Usaha",
            "part" => "tu",
            "staf" => Pekerja::all()->where('jabatan', "Staf Tata Usaha")->sortBy('nama')
        ]);
    }

    public function indexLain() {
        return view('pekerja.pegawai-lain.index', [
            "title" => "Data Pegawai Lain",
            "part" => "lainnya",
            "staf" => Pekerja::all()->where('jabatan', "Staf Lainnya")->sortBy('nama')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('pekerja.tambah', [
            "title" => "Tambah Data Pegawai",
            "part" => "pegawai",
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
            $nama_file = Str::slug($request->nama);
            $validatedData["foto_profil"] = $request->file("foto_profil")->storeAs("profil-pekerja", "$nama_file.$file_ext");
        }

        if (!($request->nip)) {
            $validatedData["nip"] = "-";
        }

        Pekerja::create($validatedData);
        Pekerja::updateData();

        if ($request->jabatan == "Guru") {
            return redirect('/guru')->with('success', "Data pegawai baru, $request->nama berhasil ditambahkan!");
        } elseif ($request->jabatan == "Staf Tata Usaha") {
            return redirect('/tata-usaha')->with('success', "Data pegawai baru, $request->nama berhasil ditambahkan!");
        } elseif ($request->jabatan == "Staf Lainnya") {
            return redirect('/staf-lain')->with('success', "Data pegawai baru, $request->nama berhasil ditambahkan!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pekerja  $pekerja
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerja $pekerja) {
        if ($pekerja->jabatan == 'Kepala Sekolah') {
            if (auth()->user()->role == 1) {
                $part = 'kepsek';
            } else {
                $part = 'pegawai';
            }
            $view = view('pekerja.kepsek.detail', [
                "title" => "Detail Pegawai",
                "part" => $part,
                "kepsek" => Pekerja::where('jabatan', 'Kepala Sekolah')->first()
            ]);
        } else {
            $view = view('pekerja.detail', [
                "title" => "Detail Pegawai",
                "part" => "kepegawaian",
                "pekerja" => $pekerja
            ]);
        }
        return $view;
    }

    public function showKepsek() {
        return view('pekerja.kepsek.detail', [
            "title" => "Profil Kepala Sekolah",
            "part" => "kepsek",
            "kepsek" => Pekerja::where('jabatan', 'Kepala Sekolah')->first()
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

    public function editKepsek() {
        return view('pekerja.kepsek.edit', [
            "title" => "Edit Data Kepala Sekolah",
            "part" => "kepsek",
            "kepsek" => Pekerja::where('jabatan', 'Kepala Sekolah')->first()
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
            $nama_file = Str::slug($request->nama);
            if ($pekerja->foto_profil != null || $pekerja->foto_profil != "") {
                Storage::delete($request->foto_profil);
                clearstatcache();
            }
            $validatedData["foto_profil"] = $request->file("foto_profil")->storeAs("profil-pekerja", "$nama_file.$file_ext");
        }

        Pekerja::where('id', $pekerja->id)->update($validatedData);

        if ($request->jabatan == 'Kepala Sekolah') {
            return redirect("/kepala-sekolah")->with("success", "Data Kepala Sekolah berhasil diperbarui!");
        } else {
            return redirect("/pekerja/$pekerja->id")->with("success", "Data $request->nama berhasil diperbarui!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pekerja  $pekerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pekerja $pekerja) {
        if ($pekerja->jabatan == "Kepala Sekolah") {
            return redirect('/pekerja')->with("fail", "Data Kepala Sekolah tidak bisa dihapus!");
        } else {
            if ($pekerja->foto_profil) {
                Storage::delete($pekerja->foto_profil);
            }

            Pekerja::destroy($pekerja->id);
            Pekerja::updateData();

            if ($pekerja->jabatan == "Guru") {
                return redirect('/guru')->with("success", "Data $pekerja->nama berhasil dihapus!");
            } elseif ($pekerja->jabatan == "Staf Tata Usaha") {
                return redirect('/tata-usaha')->with("success", "Data $pekerja->nama berhasil dihapus!");
            } else {
                return redirect('/staf-lain')->with("success", "Data $pekerja->nama berhasil dihapus!");
            }
        }
    }

    public function import(Request $request) {
        $validator = Validator::make($request->all(), [
            "file_impor" => "required|mimes:csv,xls,xlsx"
        ]);

        if ($validator->fails()) {
            return redirect('/pekerja')->with('fail', "Impor gagal, " . $validator->errors()->get('file_impor')[0]);
        } else {
            $file = $request->file("file_impor");

            Excel::import(new PekerjaImport, $file);

            return redirect('/pekerja')->with('success', "Data pegawai telah berhasil diimpor!");
        }
    }
}