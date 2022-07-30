<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komite extends Model {
    use HasFactory;

    protected $table = 'komite';
    protected $guarded = ['id'];

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public static function resetKomite($daftarUlang) {
        $dataKomite = [
            "daftar_ulang" => $daftarUlang,
            "komite_1" => "Belum Lunas",
            "1" => "Belum Lunas",
            "2" => "Belum Lunas",
            "3" => "Belum Lunas",
            "4" => "Belum Lunas",
            "5" => "Belum Lunas",
            "6" => "Belum Lunas",
            "7" => "Belum Lunas",
            "8" => "Belum Lunas",
            "9" => "Belum Lunas",
            "10" => "Belum Lunas",
            "11" => "Belum Lunas",
            "12" => "Belum Lunas",
        ];
        DB::table('komite')->update($dataKomite);
    }
}