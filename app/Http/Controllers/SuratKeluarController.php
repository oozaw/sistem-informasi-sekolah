<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('surat-keluar.index', [
            "title" => "Data Surat Keluar",
            "part" => "surat-keluar",
            "surat_keluar" => SuratKeluar::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('surat-keluar.tambah', [
            "title" => "Tambah Surat Keluar",
            "part" => "surat-keluar"
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
            "tujuan" => "required",
            "nomor" => "required",
            "kode_tujuan" => "required",
            "instansi_asal" => "required",
            "bulan" => "required",
            "tahun" => "required",
            "tgl_keluar" => "required",
            "keterangan" => "nullable",
            "file_surat" => "required|mimes:pdf|file|max:1000"
        ]);

        $carbon = new Carbon($request->tgl_keluar);
        $validatedData["tgl_keluar"] = $carbon->format('d M Y');

        if ($request->file("file_surat")) {
            $file_ext = $request->file('file_surat')->getClientOriginalExtension();
            $nama_file = "$request->nomor-$request->kode_tujuan-$request->instansi_asal-$request->bulan-$request->tahun.$file_ext";
            $validatedData['file_surat'] = $request->file('file_surat')->storeAs('surat-keluar', $nama_file);
        }

        SuratKeluar::create($validatedData);

        return redirect('/surat-keluar')->with('success', "Data Surat Keluar baru telah berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(SuratKeluar $suratKeluar) {
        return view('surat-keluar.detail', [
            "title" => "Detail Surat",
            "part" => "surat-keluar",
            "sk" => $suratKeluar
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratKeluar $suratKeluar) {
        $carbon = new Carbon($suratKeluar->tgl_keluar);
        $tanggal = $carbon->format('Y-m-d');

        return view('surat-keluar.edit', [
            "title" => "Edit Surat Keluar",
            "part" => "surat-keluar",
            "surat" => $suratKeluar,
            "tanggal" => $tanggal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratKeluar $suratKeluar) {
        $rules = [
            "tujuan" => "required",
            "nomor" => "required",
            "kode_tujuan" => "required",
            "instansi_asal" => "required",
            "bulan" => "required",
            "tahun" => "required",
            "tgl_keluar" => "required",
            "keterangan" => "nullable",
            "file_surat" => "max:1000"
        ];

        if ($request->option_file == "yes") {
            $rules["file_surat"] = "required|mimes:pdf|file|max:1000";
        }

        $validatedData = $request->validate($rules);

        $carbon = new Carbon($request->tgl_keluar);
        $validatedData["tgl_keluar"] = $carbon->format('d M Y');

        if ($request->file("file_surat")) {
            $file_ext = $request->file('file_surat')->getClientOriginalExtension();
            $nama_file = "$request->nomor-$request->kode_tujuan-$request->instansi_asal-$request->bulan-$request->tahun.$file_ext";
            Storage::delete($nama_file);
            $validatedData['file_surat'] = $request->file('file_surat')->storeAs('surat-keluar', $nama_file);
        }

        SuratKeluar::where("id", $suratKeluar->id)->update($validatedData);

        return redirect("/surat-keluar/$suratKeluar->id")->with("success", "Data surat ke $suratKeluar->tujuan berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratKeluar $suratKeluar) {
        SuratKeluar::destroy($suratKeluar->id);

        return redirect('/surat-keluar')->with('success', "Data surat ke $suratKeluar->tujuan berhasil dihapus!");
    }
}