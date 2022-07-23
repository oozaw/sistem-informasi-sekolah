<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('tahun-ajaran.index', [
            "title" => "Tahun Pelajaran",
            "part" => "tahun-ajaran",
            "tahun_ajaran" => TahunAjaran::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('tahun-ajaran.tambah', [
            "title" => "Tambah Tahun Pelajaran",
            "part" => "tahun-ajaran",
            "kelas" => Kelas::all()->sortBy('tingkatan'),
            "siswa" => Siswa::all()
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
            "tahun_ajaran" => "required",
            "status" => "required",
            "jml_siswa" => "nullable|numeric",
            "jml_siswa_baru" => "nullable|numeric",
            "jml_siswa_lulus" => "nullable|numeric",
            "jml_siswa_keluar" => "nullable|numeric",
            "jml_prestasi" => "nullable|numeric",
            "jml_pegawai" => "nullable|numeric",
            "jml_surat_masuk" => "nullable|numeric",
            "jml_surat_keluar" => "nullable|numeric",
        ]);

        // Merubah ke kelas terbaru
        if ($request->status == '1') {
            // kenaikan kelas
            $kelas_terdaftar = Siswa::all()->pluck('kelas_id')->toArray();
            $kelas_non_kosong = Kelas::whereIn('id', $kelas_terdaftar)->whereNotIn('tingkatan', ['12'])->get();
            foreach ($kelas_non_kosong as $knk) {
                $kelas_asal = "kelas_asal_$knk->id";
                $kelas_tujuan = "kelas_tujuan_$knk->id";
                Siswa::where('kelas_id', $request->$kelas_asal)->update(array('kelas_id' => $request->$kelas_tujuan));
            }

            // tinggal kelas/tidak lulus
            $id_siswa_tidak_lulus = [];
            if ($request->jml_siswa_tinggal_kelas != 0) {
                $jml = $request->jml_siswa_tinggal_kelas;
                for ($i = 1; $i <= $jml; $i++) {
                    $index_siswa = "siswa_$i";
                    $index_kelas = "kelas_tinggal_$i";
                    Siswa::where('id', $request->$index_siswa)->update(array('kelas_id' => $request->$index_kelas));

                    array_push($id_siswa_tidak_lulus, $request->$index_siswa);
                }
            }

            // kelulusan
            $kelas_12 = Kelas::where('tingkatan', 12)->pluck('id')->toArray();
            $jml_siswa_lulus = Siswa::whereIn('kelas_id', $kelas_12)->whereNotIn('id', $id_siswa_tidak_lulus)->count();
            TahunAjaran::where('status', '1')->update(array('jml_siswa_lulus' => $jml_siswa_lulus));
            Siswa::whereIn('kelas_id', $kelas_12)->whereNotIn('id', $id_siswa_tidak_lulus)->delete();

            TahunAjaran::where('status', '1')->update(array('status' => '0'));
        }

        if (!($request->jml_siswa)) {
            $validatedData['jml_siswa'] = 0;
        }
        if (!($request->jml_siswa_baru)) {
            $validatedData['jml_siswa_baru'] = 0;
        }
        if (!($request->jml_siswa_lulus)) {
            $validatedData['jml_siswa_lulus'] = 0;
        }
        if (!($request->jml_siswa_keluar)) {
            $validatedData['jml_siswa_keluar'] = 0;
        }
        if (!($request->jml_prestasi)) {
            $validatedData['jml_prestasi'] = 0;
        }
        if (!($request->jml_pegawai)) {
            $validatedData['jml_pegawai'] = 0;
        }
        if (!($request->jml_surat_masuk)) {
            $validatedData['jml_surat_masuk'] = 0;
        }
        if (!($request->jml_surat_keluar)) {
            $validatedData['jml_surat_keluar'] = 0;
        }

        TahunAjaran::create($validatedData);

        // update jumlah data di tahun ajaran aktif
        $jml_seluruh_siswa = Siswa::all()->count();
        TahunAjaran::where('status', 1)->update(array('jml_siswa' => $jml_seluruh_siswa));

        return redirect('/tahun-ajaran')->with('success', "Data tahun pelajaran baru, $request->tahun_ajaran berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function show(TahunAjaran $tahunAjaran) {
        $tahunAjaran->status == '1' ? $status = "Aktif" : $status = "";

        return view('tahun-ajaran.detail', [
            "title" => "Tahun Pelajaran $status",
            "part" => "tahun-ajaran",
            "ta" => $tahunAjaran
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function edit(TahunAjaran $tahunAjaran) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TahunAjaran $tahunAjaran) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(TahunAjaran $tahunAjaran) {
        TahunAjaran::destroy($tahunAjaran->id);

        return redirect("/tahun-ajaran")->with("success", "Data $tahunAjaran->tahun_ajaran berhasil dihapus!");
    }

    public function getDataForm(Request $request) {
        if ($request->status == 2) {
            return view('tahun-ajaran.partials.form-data');
        } else {
            $kelas_terdaftar = Siswa::all()->pluck('kelas_id')->toArray();
            $kelas_non_kosong = Kelas::whereIn('id', $kelas_terdaftar)->get()->sortBy('tingkatan');
            $data = [
                "kelas" => Kelas::all()->sortBy('tingkatan'),
                "kelas_non_kosong" => $kelas_non_kosong,
            ];

            return view('tahun-ajaran.partials.form-naik-kelas', $data);
        }
    }

    public function getSiswaOption(Request $request) {
        if ($request->jml_siswa != 0) {
            $data = [
                "jml_siswa" => $request->jml_siswa,
                "siswa" => Siswa::all(),
                "kelas" => Kelas::all()->sortBy('tingkatan')
            ];

            return view('tahun-ajaran.partials.siswa-option', $data);
        }
    }
}