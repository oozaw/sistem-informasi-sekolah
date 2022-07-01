<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class SiswaImport implements ToModel, WithStartRow, WithUpserts {
    /**
     * @return int
     */
    public function startRow(): int {
        return 5;
    }

    /**
     * @return string|array
     */
    public function uniqueBy() {
        return ['nisn', 'nis', 'no_telp'];
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row) {
        if (!isset($row[0])) {
            return null;
        }

        $kelas = Kelas::all();
        $kelas_id = "";

        foreach ($kelas as $k) {
            if ($row[3] == $k->nama) {
                $kelas_id = $k->id;
            }
        }

        return new Siswa([
            "nama" => $row[1],
            "gender" => $row[2],
            "nisn" => $row[4],
            "nis" => $row[5],
            "no_telp" => $row[6],
            "tempat_tinggal" => $row[7],
            "kelas_id" => $kelas_id
        ]);
    }
}