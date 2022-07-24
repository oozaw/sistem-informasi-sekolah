<?php

namespace App\Imports;

use App\Models\Prestasi;
use App\Models\TahunAjaran;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PrestasiImport implements ToModel, WithStartRow {
    /**
     * @return int
     */
    public function startRow(): int {
        return 5;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row) {
        if (!isset($row[1])) {
            return null;
        }

        $carbon = Carbon::createFromLocaleIsoFormat('D MMMM Y', 'id', $row[6]);
        $tgl = $carbon->format('Y-m-d');
        $tahun = $carbon->year;
        $id_tahunajaran_aktif = TahunAjaran::where('status', 1)->first()->id;

        return new Prestasi([
            "tahunajaran_id" => $id_tahunajaran_aktif,
            "nama" => $row[1],
            "jenis" => $row[5],
            "capaian" => $row[3],
            "tanggal" => $tgl,
            "tingkat" => $row[2],
            "bidang" => $row[4],
            "tahun" => $tahun
        ]);
    }
}