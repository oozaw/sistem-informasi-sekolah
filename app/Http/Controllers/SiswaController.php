<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Prestasi;
use App\Models\Perwakilan;
use App\Imports\SiswaImport;
use App\Models\Komite;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller {
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
    public function create() {
        return view('siswa.tambah', [
            "title" => "Tambah Siswa",
            "part" => "siswa",
            "kelas" => Kelas::all(),
            "prestasi" => Prestasi::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedDataSiswa = $request->validate([
            "nama" => "required",
            "nis" => "required|unique:siswa|numeric",
            "nisn" => "required|unique:siswa|numeric",
            "gender" => "required",
            "no_telp" => "nullable|numeric|digits_between:12,14",
            "tempat_tinggal" => "required",
            "kelas_id" => "required",
            "foto_profil" => "nullable|image|max:10000"
        ]);

        if ($request->file("foto_profil")) {
            $file_ext = $request->file('foto_profil')->getClientOriginalExtension();
            $validatedDataSiswa["foto_profil"] = $request->file("foto_profil")->storeAs("profil-siswa", "$request->nisn.$file_ext");
        }

        // if (!($request->no_telp)) {
        //     $validatedDataSiswa["no_telp"] = "-";
        // }

        $siswa = Siswa::create($validatedDataSiswa);

        $idSiswa = $siswa->id;

        // tambah prestasi siswa baru ke tabel perwakilan
        if ($request->option_prestasi == 'yes') {
            $dataPrestasi = ['siswa_id' => $idSiswa];
            for ($i = 1; $i <= $request->jumlah_prestasi; $i++) {
                $prestasi = "prestasi$i";
                $dataPrestasi['prestasi_id'] = $request->$prestasi;
                Perwakilan::create($dataPrestasi);
            }
        }

        // tambah data siswa ke komite
        $dataKomite = [
            'siswa_id' => $idSiswa,
            'bebas1' => '0',
            'bebas2' => '0',
            'daftar_ulang' => TahunAjaran::where('status', 1)->pluck('nominal_daftar_ulang')->first(),
            'komite_1' => "Belum Lunas",
            'kartu' => null,
            '1' => 'Belum Lunas',
            '2' => 'Belum Lunas',
            '3' => 'Belum Lunas',
            '4' => 'Belum Lunas',
            '5' => 'Belum Lunas',
            '6' => 'Belum Lunas',
            '7' => 'Belum Lunas',
            '8' => 'Belum Lunas',
            '9' => 'Belum Lunas',
            '10' => 'Belum Lunas',
            '11' => 'Belum Lunas',
            '12' => 'Belum Lunas',
        ];
        Komite::create($dataKomite);

        // update jumlah data di tahun ajaran aktif
        $jml_seluruh_siswa = Siswa::all()->count();
        TahunAjaran::where('status', 1)->update(array('jml_siswa' => $jml_seluruh_siswa));
        if ($siswa->kelas->tingkatan == 10) {
            $id_kelas_10 = Kelas::where('tingkatan', 10)->pluck('id')->toArray();
            $jml_siswa_baru = Siswa::whereIn('kelas_id', $id_kelas_10)->count();
            TahunAjaran::where('status', 1)->update(array('jml_siswa_baru' => $jml_siswa_baru));
        }

        return redirect('/siswa')->with("success", "Data siswa baru, $request->nama berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa) {
        $prestasi = Siswa::where('id', $siswa->id)->get()->flatMap->prestasi;

        return view('siswa.detail', [
            "title" => "Detail Siswa",
            "part" => "siswa",
            "siswa" => $siswa,
            "prestasi" => $prestasi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa) {
        $prestasiSiswa = Perwakilan::where('siswa_id', $siswa->id)->get();
        $jumlahPrestasi = count($prestasiSiswa);

        return view('siswa.edit', [
            "title" => "Edit Data Siswa",
            "part" => "siswa",
            "siswa" => $siswa,
            "kelas" => Kelas::all(),
            "prestasi" => Prestasi::all(),
            "prestasiSiswa" => $prestasiSiswa,
            "jumlahPrestasi" => $jumlahPrestasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa) {
        $rules = [
            "nama" => "required",
            "kelas_id" => "required",
            "gender" => "required",
            "tempat_tinggal" => "required",
            "foto_profil" => "nullable|image|max:10000"
        ];

        if ($request->nisn != $siswa->nisn) {
            $rules["nisn"] = "required|unique:siswa";
        } else {
            $rules["nisn"] = "required";
        }

        if ($request->no_telp != $siswa->no_telp) {
            $rules["no_telp"] = "nullable|unique:siswa";
        } else {
            $rules["no_telp"] = "nullable";
        }

        if ($request->nis != $siswa->nis) {
            $rules["nis"] = "required|unique:siswa";
        } else {
            $rules["nis"] = "required";
        }

        $validatedData = $request->validate($rules);

        if (!($request->no_telp)) {
            $validatedData["no_telp"] = "-";
        }

        if ($request->file("foto_profil")) {
            $file_ext = $request->file('foto_profil')->getClientOriginalExtension();
            $foto_profil = Siswa::getProfil($siswa->id);
            if ($foto_profil != null || $foto_profil != "") {
                Storage::delete($foto_profil);
                clearstatcache();
            }
            $validatedData["foto_profil"] = $request->file("foto_profil")->storeAs("profil-siswa", "$request->nisn.$file_ext");
        }

        Siswa::where("id", $siswa->id)->update($validatedData);

        $prestasiSiswa = Perwakilan::where('siswa_id', $siswa->id)->get();
        $jumlahPrestasi = count($prestasiSiswa);
        $dataPrestasi = ['siswa_id' => $siswa->id];

        // untuk prestasi yang sudah ada sebelumnya
        for ($i = 1; $i <= $jumlahPrestasi; $i++) {
            $prestasi = "prestasi$i";
            if ($request->$prestasi == "kosong") {
                Perwakilan::destroy($prestasiSiswa[$i - 1]->id);
            } else {
                $dataPrestasi['prestasi_id'] = $request->$prestasi;
                Perwakilan::where("id", $prestasiSiswa[$i - 1]->id)->update($dataPrestasi);
            }
        }

        // untuk prestasi baru
        if ($request->option_prestasi == 'yes') {
            for ($i = 1; $i <= $request->jumlah_prestasi; $i++) {
                $counterPrestasiTotal = $i + $jumlahPrestasi;
                $prestasi = "prestasi$counterPrestasiTotal";
                $dataPrestasi['prestasi_id'] = $request->$prestasi;
                Perwakilan::create($dataPrestasi);
            }
        }

        // update jumlah data di tahun ajaran aktif
        $tingkatan = Kelas::where("id", $request->kelas_id)->first()->tingkatan;
        if ($siswa->kelas->tingkatan != $tingkatan) {
            // update jml siswa baru
            $id_kelas_10 = Kelas::where('tingkatan', 10)->pluck('id')->toArray();
            $jml_siswa_baru = Siswa::whereIn('kelas_id', $id_kelas_10)->count();
            TahunAjaran::where('status', 1)->update(array('jml_siswa_baru' => $jml_siswa_baru));
        }

        return redirect("/siswa/$siswa->id")->with("success", "Data $siswa->nama berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Siswa $siswa) {
        if ($siswa->foto_profil) {
            Storage::delete($siswa->foto_profil);
        }

        Siswa::destroy($siswa->id);
        Komite::where('siswa_id', $siswa->id)->delete();

        // update jumlah data di tahun ajaran aktif
        if ($request->alasan == 'keluar') {
            $jml_siswa_keluar = TahunAjaran::where('status', 1)->first()->jml_siswa_keluar;
            TahunAjaran::where('status', 1)->update(array('jml_siswa_keluar' => $jml_siswa_keluar + 1));
        }

        $jml_seluruh_siswa = Siswa::all()->count();
        TahunAjaran::where('status', 1)->update(array('jml_siswa' => $jml_seluruh_siswa));
        if ($siswa->kelas->tingkatan == 10) {
            $id_kelas_10 = Kelas::where('tingkatan', 10)->pluck('id')->toArray();
            $jml_siswa_baru = Siswa::whereIn('kelas_id', $id_kelas_10)->count();
            TahunAjaran::where('status', 1)->update(array('jml_siswa_baru' => $jml_siswa_baru));
        }

        return redirect("/siswa")->with("success", "Data $siswa->nama berhasil dihapus!");
    }

    public function downloadFormat() {
        $spreadsheet = IOFactory::load(public_path('/template/Template Impor Data Siswa.xlsx'));
        $worksheet = $spreadsheet->getActiveSheet();

        $kelas = Kelas::all();
        $counter = 5;
        foreach ($kelas as $k) {
            $worksheet->setCellValue("J$counter", $counter - 4);
            $worksheet->setCellValue("K$counter", $k->nama);
            $counter++;
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('template/Impor Data Siswa.xlsx');

        return response()->download(public_path('/template/Impor Data Siswa.xlsx'));
    }

    public function import(Request $request) {
        $existId = Siswa::all()->pluck('id');

        $validator = Validator::make($request->all(), [
            "file_impor" => "required|mimes:csv,xls,xlsx"
        ]);

        if ($validator->fails()) {
            return redirect('/siswa')->with('fail', "Impor gagal, " . $validator->errors()->get('file_impor')[0]);
        } else {
            $file = $request->file("file_impor");

            Excel::import(new SiswaImport, $file);

            // tambah data ke komite
            $existId = Komite::all()->pluck('siswa_id')->toArray();
            $idToCreate = Siswa::whereNotIn('id', $existId)->get();
            foreach ($idToCreate as $i) {
                $dataKomite = [
                    'siswa_id' => $i->id,
                    'bebas1' => '0',
                    'bebas2' => '0',
                    'daftar_ulang' => TahunAjaran::where('status', 1)->pluck('nominal_daftar_ulang')->first(),
                    'komite_1' => "Belum Lunas",
                    'kartu' => null,
                    '1' => 'Belum Lunas',
                    '2' => 'Belum Lunas',
                    '3' => 'Belum Lunas',
                    '4' => 'Belum Lunas',
                    '5' => 'Belum Lunas',
                    '6' => 'Belum Lunas',
                    '7' => 'Belum Lunas',
                    '8' => 'Belum Lunas',
                    '9' => 'Belum Lunas',
                    '10' => 'Belum Lunas',
                    '11' => 'Belum Lunas',
                    '12' => 'Belum Lunas',
                ];
                Komite::create($dataKomite);
            }

            return redirect('/siswa')->with('success', "Data siswa telah berhasil diimpor!");
        }
    }
}