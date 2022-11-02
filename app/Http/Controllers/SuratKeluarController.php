<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pekerja;
use App\Models\SuratKeluar;
use App\Models\TahunAjaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SuratKeluarController extends Controller {
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
        return view('surat-keluar.index', [
            "title" => "Data Surat Keluar",
            "part" => "surat-keluar",
            "surat_keluar" => SuratKeluar::all()->sortBy('tgl_keluar', SORT_REGULAR, true)
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
            "nomor" => "required|unique:surat_keluar",
            "kode_tujuan" => "required",
            "instansi_asal" => "required",
            "bulan" => "required",
            "tahun" => "required",
            "tgl_keluar" => "required",
            "keterangan" => "nullable",
            "file_surat" => "required|mimes:pdf|file|max:10000"
        ]);

        $validatedData['tahunajaran_id'] = TahunAjaran::where('status', 1)->first()->id;

        if ($request->file("file_surat")) {
            $file_ext = $request->file('file_surat')->getClientOriginalExtension();
            $nama =  Str::slug("$request->nomor-$request->kode_tujuan-$request->instansi_asal-$request->bulan-$request->tahun");
            $nama_file = "$nama.$file_ext";
            $validatedData['file_surat'] = $request->file('file_surat')->storeAs('surat-keluar', $nama_file);
        }

        SuratKeluar::create($validatedData);
        SuratKeluar::updateData();

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
            $rules["file_surat"] = "required|mimes:pdf|file|max:10000";
        }

        $validatedData = $request->validate($rules);

        if ($request->file("file_surat")) {
            $file_ext = $request->file('file_surat')->getClientOriginalExtension();
            $nama =  Str::slug("$request->nomor-$request->kode_tujuan-$request->instansi_asal-$request->bulan-$request->tahun");
            $nama_file = "$nama.$file_ext";
            Storage::delete($suratKeluar->file_surat);
            clearstatcache();
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
        if ($suratKeluar->file_surat) {
            Storage::delete($suratKeluar->file_surat);
        }

        SuratKeluar::destroy($suratKeluar->id);
        SuratKeluar::updateData();

        return redirect('/surat-keluar')->with('success', "Data surat ke $suratKeluar->tujuan berhasil dihapus!");
    }

    public function createNewSurat() {
        return view('surat-keluar.create', [
            "title" => "Buat Surat Baru",
            "part" => "surat-keluar",
        ]);
    }

    public function suratPreview(Request $request) {
        $validator = Validator::make($request->all(), [
            "individu_tujuan" => "required",
            "tujuan" => "required",
            "lampiran" => "nullable",
            "perihal" => "required",
            "nomor" => "required",
            "kode_tujuan" => "required",
            "instansi_asal" => "required",
            "bulan" => "required",
            "tahun" => "required",
            "tgl_keluar" => "required",
            "keterangan" => "nullable",
            "isi_surat" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "error" => $validator->errors()->toArray(),
                "message" => "gagal generate"
            ]);
        } else {
            $validatedData = $validator->validated();

            $carbon = new Carbon($request->tgl_keluar);
            $validatedData["tgl_keluar"] = $carbon->isoformat('D MMMM Y');
            $validatedData["tgl_hari"] = $carbon->isoformat('dddd, D MMMM Y');

            if (!$request->lampiran) {
                $validatedData['lampiran'] = '-';
            }

            $data = [
                "title" => "Surat Baru",
                "part" => "surat-keluar",
                "kepsek" => Pekerja::where('jabatan', 'Kepala Sekolah')->first()
            ];
            $data = array_merge($data, $validatedData);

            return view('surat-keluar.layouts.surat', $data);
        }
    }

    public function generatePDF(Request $request) {
        $validatedData = $request->all();

        $carbon = new Carbon($request->tgl_keluar);
        $validatedData["tgl_keluar_pdf"] = $carbon->isoformat('D MMMM Y');
        $validatedData["tgl_hari"] = $carbon->isoformat('dddd, D MMMM Y');

        if (!$request->lampiran) {
            $validatedData['lampiran'] = '-';
        }

        $data = [
            "title" => "Surat Baru",
            "part" => "surat-keluar",
            "kepsek" => Pekerja::where('jabatan', 'Kepala Sekolah')->first()
        ];
        $data = array_merge($data, $validatedData);

        $pdf = PDF::loadView('surat-keluar.layouts.suratPDF', $data)->setPaper('A4', 'portrait');
        $content = $pdf->download()->getOriginalContent();
        $nama_file = "$request->nomor-$request->kode_tujuan-$request->instansi_asal-$request->bulan-$request->tahun.pdf";
        $path = "surat-keluar/$nama_file";
        Storage::put($path, $content);
        $validatedData['file_surat'] = $path;
        $validatedData['tahunajaran_id'] = TahunAjaran::where('status', 1)->first()->id;

        SuratKeluar::create($validatedData);
        SuratKeluar::updateData();

        return $pdf->stream($nama_file);
    }
}