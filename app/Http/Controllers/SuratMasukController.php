<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat-masuk.index', [
            "title" => "Surat Masuk",
            "part" => "surat-masuk",
            "surat_masuk" => SuratMasuk::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat-masuk.tambah', [
            "title" => "Tambah Surat Masuk",
            "part" => "surat-masuk"
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
        $file_ext = $request->file('file_surat')->getClientOriginalExtension();
        $nama_file = "$request->nomor-$request->kode_tujuan-$request->instansi_asal-$request->bulan-$request->tahun.$file_ext";
        
        $validatedData = $request->validate([
            "asal" => "required",
            "nomor" => "required",
            "kode_tujuan" => "required",
            "instansi_asal" => "required",
            "bulan" => "required",
            "tahun" => "required",
            "tgl_masuk" => "required",
            "keterangan" => "nullable",
            "file_surat" => "required|mimes:pdf|file|max:1000"
        ]);
        
        if ($request->file("file_surat")) {
            $validatedData['file_surat'] = $request->file('file_surat')->storeAs('surat-masuk', $nama_file);
        }

        SuratMasuk::create($validatedData);

        return redirect('/surat-masuk')->with('success', "Data Surat Masuk baru telah berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(SuratMasuk $suratMasuk)
    {
        return view("surat-masuk.detail", [
            "title" => "Detail Surat",
            "part" => "surat-masuk",
            "sm" => $suratMasuk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratMasuk $suratMasuk)
    {
        return view('surat-masuk.edit', [
            "title" => "Edit Surat Masuk",
            "part" => "surat-masuk",
            "surat" => $suratMasuk
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $rules = [
            "asal" => "required",
            "nomor" => "required",
            "kode_tujuan" => "required",
            "instansi_asal" => "required",
            "bulan" => "required",
            "tahun" => "required",
            "tgl_masuk" => "required",
            "keterangan" => "nullable",
            "file_surat" => "max:1000"
        ];
        
        if ($request->option_file == "yes") {
            $rules["file_surat"] = "required|mimes:pdf|file|max:1000";
        }
        
        $validatedData = $request->validate($rules);
        
        $file_ext = $request->file('file_surat')->getClientOriginalExtension();
        $nama_file = "$request->nomor-$request->kode_tujuan-$request->instansi_asal-$request->bulan-$request->tahun.$file_ext";
        
        if ($request->file("file_surat")) {
            Storage::delete($nama_file);
            $validatedData['file_surat'] = $request->file('file_surat')->storeAs('surat-masuk', $nama_file);
        }
        
        SuratMasuk::where("id", $suratMasuk->id)->update($validatedData);

        return redirect("/surat-masuk")->with("success", "Data surat dari $suratMasuk->asal berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratMasuk $suratMasuk)
    {
        SuratMasuk::destroy($suratMasuk->id);

        return redirect('/surat-masuk')->with("success", "Data surat dari $suratMasuk->asal berhasil dihapus!");
    }
}