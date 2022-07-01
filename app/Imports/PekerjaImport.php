<?php

namespace App\Imports;

use App\Models\Pekerja;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PekerjaImport implements ToModel, WithStartRow, WithUpserts {
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
        return ['nip', 'email', 'no_telp'];
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

        return new Pekerja([
            "nama" => $row[1],
            "email" => $row[6],
            "no_hp" => $row[5],
            "nip" => $row[3],
            "jabatan" => $row[2],
            "gender" => $row[4],
            "tempat_tinggal" => $row[7]
        ]);
    }
}