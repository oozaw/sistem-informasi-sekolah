<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Prestasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Imports\PrestasiImport;
use App\Models\TahunAjaran;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PrestasiController extends Controller {
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
        return view('prestasi.index', [
            "title" => "Data Prestasi",
            "part" => "prestasi",
            "prestasi" => Prestasi::all()->sortBy('tanggal', SORT_REGULAR, true)
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
            "piagam" => "mimes:pdf|file|max:10000"
        ]);

        $tahun_ajaran_id = TahunAjaran::where('status', 1)->first()->id;
        $validatedData['tahunajaran_id'] = $tahun_ajaran_id;

        $carbon = new Carbon($request->tanggal);
        $validatedData["tahun"] = $carbon->year;

        if ($request->file("piagam")) {
            $file_ext = $request->file('piagam')->getClientOriginalExtension();
            $nama_without_space = Str::slug("$request->nama-$carbon->year-$request->capaian-$request->tingkat");
            $nama_file = "$nama_without_space.$file_ext";
            $validatedData['piagam'] = $request->file('piagam')->storeAs('prestasi', $nama_file);
        }

        Prestasi::create($validatedData);
        Prestasi::updateData();

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
        $carbon = new Carbon($prestasi->tanggal);
        $tanggal = $carbon->format('Y-m-d');

        return view('prestasi.edit', [
            "title" => "Edit Data Prestasi",
            "part" => "prestasi",
            "prestasi" => $prestasi,
            "tanggal" => $tanggal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestasi $prestasi) {
        $rules = [
            "nama" => "required",
            "jenis" => "required",
            "tingkat" => "required",
            "capaian" => "required",
            "tanggal" => "required",
            "bidang" => "required",
            "piagam" => "mimes:pdf|file|max:10000"
        ];

        $validatedData = $request->validate($rules);

        $carbon = new Carbon($request->tanggal);
        $validatedData["tahun"] = $carbon->year;

        if ($request->file("piagam")) {
            $file_ext = $request->file('piagam')->getClientOriginalExtension();
            $nama_without_space = Str::slug("$request->nama-$carbon->year-$request->capaian-$request->tingkat");
            $nama_file = "$nama_without_space.$file_ext";
            if ($prestasi->piagam != null || $prestasi != "") {
                Storage::delete($prestasi->piagam);
                clearstatcache();
            }
            $validatedData['piagam'] = $request->file('piagam')->storeAs('prestasi', $nama_file);
        }

        Prestasi::where("id", $prestasi->id)->update($validatedData);

        return redirect("/prestasi/$prestasi->id")->with("success", "Data prestasi berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestasi $prestasi) {
        if ($prestasi->piagam) {
            Storage::delete($prestasi->piagam);
        }

        Prestasi::destroy($prestasi->id);
        Prestasi::updateData();

        return redirect('/prestasi')->with('success', "Data prestasi $prestasi->nama berhasil dihapus!");
    }

    public function import(Request $request) {
        $validator = Validator::make($request->all(), [
            "file_impor" => "required|mimes:csv,xls,xlsx"
        ]);

        if ($validator->fails()) {
            return redirect('/prestasi')->with('fail', "Impor gagal, " . $validator->errors()->get('file_impor')[0]);
        } else {
            $file = $request->file("file_impor");

            Excel::import(new PrestasiImport, $file);
            Prestasi::updateData();

            return redirect('/prestasi')->with('success', "Data prestasi telah berhasil diimpor!");
        }
    }
}