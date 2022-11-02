<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Komite;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class KomiteController extends Controller {
    public function __construct() {
        // membatasi akses kepsek hanya ke method index saja
        $this->middleware('is-kepsek')->except(['index', 'getDataKomite', 'exportKomite']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tgl = new Carbon();
        $tgl->month <= 6 ? $semester = 2 : $semester = 1;
        $semester == 1 ? $bln_awal = 7 : $bln_awal = 1;

        return view('komite.index', [
            "title" => "Pembayaran Komite Siswa",
            "part" => "komite",
            "tgl" => $tgl,
            "kelas" => Kelas::all(),
            "semester" => $semester,
            "bln_awal" => $bln_awal,
            "komite" => Komite::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Komite  $komite
     * @return \Illuminate\Http\Response
     */
    public function show(Komite $komite) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Komite  $komite
     * @return \Illuminate\Http\Response
     */
    public function edit(Komite $komite) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Komite  $komite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Komite $komite) {
        //
    }

    public function getDataKomite(Request $request) {
        if ($request->kelas != "") {
            $siswa = Siswa::where('kelas_id', $request->kelas)->pluck('id')->toArray();
            $komite = Komite::whereIn('siswa_id', $siswa)->get();
            $request->semester == 'Ganjil' ? $bln_awal = 7 : $bln_awal = 1;

            if ($komite->count() == 0) {
                return response()->json([
                    "status" => 0,
                    "page" => view('komite.partials.empty')->render(),
                    "message" => "gagal generate"
                ]);
            } else {
                $data = [
                    "semester" => $request->semester,
                    "komite" => $komite,
                    "bln_awal" => $bln_awal
                ];

                return view('komite.partials.data', $data);
            }
        }
    }

    public function updateKomite(Request $request) {
        $semester = $request->semester;
        $kelas_id = $request->kelas;

        $idSiswa = Siswa::getSiswaKelas($kelas_id)->pluck('id')->toArray();
        $semester == 'Ganjil' ? $bln_awal = 7 : $bln_awal = 1;
        $komite = Komite::whereIn('siswa_id', $idSiswa)->get();

        foreach ($komite as $k) {
            // index data
            $indexDaftarUlang = "daftar_ulang_$k->id";

            // proses daftar ulang
            if ($request->$indexDaftarUlang == "Lunas") {
                $daftarUlang = 0;
            } else {
                $daftarUlang = $request->$indexDaftarUlang;
            }

            $data = [
                "daftar_ulang" => $daftarUlang,
            ];

            // kartu komite
            if ($request->file("kartu_$k->id")) {
                $file_ext = $request->file("kartu_$k->id")->getClientOriginalExtension();
                $kartu = Komite::getKartu($k->id);
                if ($kartu != null) {
                    Storage::delete($kartu);
                    clearstatcache();
                }
                $data["kartu"] = $request->file("kartu_$k->id")->storeAs("kartu-komite", "$k->id.$file_ext");
            }

            // komite semester 1
            if ($semester == 'Ganjil') {
                $data["komite_1"] = "Lunas";
                for ($i = 7; $i <= 12; $i++) {
                    $idRequest = 'komite_' . $k->id . '_' . $i;
                    if ($request->$idRequest == "Belum Lunas") {
                        $data["komite_1"] = "Belum Lunas";
                        break;
                    }
                }
            }

            // komite per bulan
            for ($i = $bln_awal; $i <= $bln_awal + 5; $i++) {
                $idRequest = 'komite_' . $k->id . '_' . $i;
                $data["$i"] = $request->$idRequest;
            }

            DB::table('komite')->where('id', $k->id)->update($data);
        }

        return response()->json([
            "status" => 1,
            "alert" => view("komite.partials.alert-success", ['message' => "Data pembayaran komite berhasil disimpan!"])->render(),
        ]);
    }

    public function indexBebasKomite() {
        $tgl = new Carbon();
        $tgl->month <= 6 ? $semester = 2 : $semester = 1;
        $kelas_terdaftar = Siswa::all()->pluck('kelas_id')->toArray();
        $kelas_non_kosong = Kelas::whereIn('id', $kelas_terdaftar)->get()->sortBy('tingkatan');

        return view("komite.tambah-bebas-komite", [
            "title" => "Data Siswa Bebas Komite",
            "part" => "komite",
            "komite" => Komite::whereNotIn('bebas1', [0])->orWhereNotIn('bebas2', [0])->get(),
            "kelas" => $kelas_non_kosong,
            "tgl" => $tgl
        ]);
    }

    public function getDataSiswa(Request $request) {
        $kelasId = $request->kelas_id;
        $siswa = Siswa::where('kelas_id', $kelasId)->get()->sortBy('nama');

        return view("komite.partials.data-siswa", [
            "siswa" => $siswa
        ]);
    }

    public function updateBebasKomite(Request $request) {
        $siswaId = $request->siswa_id;
        $data = [
            "bebas1" => $request->bebas1,
            "bebas2" => $request->bebas2
        ];
        $oldKomite = Komite::where('siswa_id', $siswaId)->first();
        $oldBebas1 = $oldKomite->bebas1;
        $oldBebas2 = $oldKomite->bebas2;

        if ($oldBebas1 != $request->bebas1) {
            // update sem. 1
            for ($i = 7; $i <= $request->bebas1 + 6; $i++) {
                $data["$i"] = 'Lunas';
            }
            if ($request->bebas1 != 6) {
                for ($i = $request->bebas1 + 7; $i <= 12; $i++) {
                    $data["$i"] = 'Belum Lunas';
                }
            }
        }

        if ($oldBebas2 != $request->bebas2) {
            // update sem. 2
            for ($i = 1; $i <= $request->bebas2; $i++) {
                $data["$i"] = 'Lunas';
            }
            if ($request->bebas2 != 6) {
                for ($i = $request->bebas2 + 1; $i <= 6; $i++) {
                    $data["$i"] = 'Belum Lunas';
                }
            }
        }

        DB::table('komite')->where('siswa_id', $siswaId)->update($data);
        // cek data komite sem. 1
        $komite = Komite::where("siswa_id", $siswaId)->first();
        Komite::cekKomiteS1($komite);

        return redirect('/bebas-komite')->with('success', "Data penerima beasiswa bebas komite berhasil disimpan!");
    }

    public function exportKomite(Request $request) {
        $request->semester_hidden == 'Ganjil' ? $templatePath = '/template/Template Pembayaran Komite S1.xlsx' : $templatePath = '/template/Template Pembayaran Komite S2.xlsx';
        $spreadsheet = IOFactory::load(public_path($templatePath));

        $tahunAjaran = TahunAjaran::where('status', 1)->pluck('tahun_ajaran')->first();
        $kelas_terdaftar = Siswa::all()->pluck('kelas_id')->toArray();
        $kelas = Kelas::whereIn('id', $kelas_terdaftar)->get()->sortBy('tingkatan');

        $request->semester_hidden == 'Ganjil' ? $bln_awal = 7 : $bln_awal = 1;
        if ($request->semester_hidden == 'Ganjil') {
            $b1 = 7;
            $b2 = 8;
            $b3 = 9;
            $b4 = 10;
            $b5 = 11;
            $b6 = 12;
        } else {
            $b1 = 1;
            $b2 = 2;
            $b3 = 3;
            $b4 = 4;
            $b5 = 5;
            $b6 = 6;
        }

        foreach ($kelas as $k) {
            // copy sheet dari template
            $clonedWorksheet = clone $spreadsheet->getSheetByName('Template');
            $clonedWorksheet->setTitle("$k->nama");
            $spreadsheet->addSheet($clonedWorksheet);

            $worksheet = $spreadsheet->getSheetByName("$k->nama");
            $worksheet->getCell('A2')->setValue("TAHUN AJARAN $tahunAjaran");
            $worksheet->getCell('A5')->setValue("KELAS $k->nama");

            $counter = 8;
            $dataKomite = [];
            foreach ($k->siswa as $s) {
                $komite = Komite::where('siswa_id', $s->id)->first();
                $komite->daftar_ulang == 0 ? $daftarUlang = 'Lunas' : $daftarUlang = $komite->daftar_ulang;
                if ($request->semester_hidden == 'Ganjil') {
                    array_push($dataKomite, [
                        $counter - 7, $s->nama, $daftarUlang, $komite->$b1, $komite->$b2, $komite->$b3, $komite->$b4, $komite->$b5, $komite->$b6,
                    ]);
                } else {
                    array_push($dataKomite, [
                        $counter - 7, $s->nama, $daftarUlang, $komite->komite_1, $komite->$b1, $komite->$b2, $komite->$b3, $komite->$b4, $komite->$b5, $komite->$b6,
                    ]);
                }
                $counter++;
            }
            $worksheet->fromArray($dataKomite, null, 'A8');
            // ganti warna cell kuning untuk yang belum 
            for ($i = 8; $i <= $k->siswa->count() + 7; $i++) {
                if ($request->semester_hidden == 'Genap') {
                    if ($worksheet->getCell("J$i")->getValue() != 'Lunas') {
                        $worksheet->getStyle("J$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB(Color::COLOR_YELLOW);
                    } else {
                        $worksheet->getStyle("J$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("99CCFF");
                    }
                }
                if ($worksheet->getCell("C$i")->getValue() != 'Lunas' && $worksheet->getCell("C$i")->getValue() != 'Rp. 0') {
                    $worksheet->getStyle("C$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB(Color::COLOR_YELLOW);
                } else {
                    $worksheet->getStyle("C$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("99CCFF");
                }
                if ($worksheet->getCell("D$i")->getValue() != 'Lunas') {
                    $worksheet->getStyle("D$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB(Color::COLOR_YELLOW);
                } else {
                    $worksheet->getStyle("D$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("99CCFF");
                }
                if ($worksheet->getCell("E$i")->getValue() != 'Lunas') {
                    $worksheet->getStyle("E$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB(Color::COLOR_YELLOW);
                } else {
                    $worksheet->getStyle("E$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("99CCFF");
                }
                if ($worksheet->getCell("F$i")->getValue() != 'Lunas') {
                    $worksheet->getStyle("F$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB(Color::COLOR_YELLOW);
                } else {
                    $worksheet->getStyle("F$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("99CCFF");
                }
                if ($worksheet->getCell("G$i")->getValue() != 'Lunas') {
                    $worksheet->getStyle("G$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB(Color::COLOR_YELLOW);
                } else {
                    $worksheet->getStyle("G$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("99CCFF");
                }
                if ($worksheet->getCell("H$i")->getValue() != 'Lunas') {
                    $worksheet->getStyle("H$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB(Color::COLOR_YELLOW);
                } else {
                    $worksheet->getStyle("H$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("99CCFF");
                }
                if ($worksheet->getCell("I$i")->getValue() != 'Lunas') {
                    $worksheet->getStyle("I$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB(Color::COLOR_YELLOW);
                } else {
                    $worksheet->getStyle("I$i")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("99CCFF");
                }
            }
        }
        // hapus sheet template
        $sheetIndex = $spreadsheet->getIndex(
            $spreadsheet->getSheetByName('Template')
        );
        $spreadsheet->removeSheetByIndex($sheetIndex);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $savedPath = "template/Data Pembayaran Komite Semester $request->semester_hidden.xlsx";
        $writer->save($savedPath);

        return response()->download(public_path($savedPath));
    }

    public function refreshData() {
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

        return response()->json([
            "status" => 1,
            "alert" => view("komite.partials.alert-success", ['message' => "Data komite berhasil diperbarui!"])->render(),
        ]);
    }
}