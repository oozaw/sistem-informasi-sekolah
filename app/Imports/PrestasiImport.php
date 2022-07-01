<?php

namespace App\Imports;

use App\Models\Prestasi;
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

        $carbon = new Carbon($row[6]);
        $tahun = $carbon->year;

        return new Prestasi([
            "nama" => $row[1],
            "jenis" => $row[5],
            "capaian" => $row[3],
            "tanggal" => $row[6],
            "tingkat" => $row[2],
            "bidang" => $row[4],
            "tahun" => $tahun
        ]);
    }
}