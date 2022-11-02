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

    public static function getKartu($id) {
        $kartu = Komite::where('id', $id)->pluck('kartu')->first();
        return $kartu;
    }

    public static function cekKomiteS1(Komite $komite) {
        $data = [];
        $data["komite_1"] = "Lunas";
        for ($i = 7; $i <= 12; $i++) {
            if ($komite->$i == "Belum Lunas") {
                $data["komite_1"] = "Belum Lunas";
                break;
            }
        }
        $komite->update($data);
    }

    public static function resetKomite($daftarUlang) {
        $dataKomite = [
            "bebas1" => '0',
            "bebas2" => '0',
            "daftar_ulang" => $daftarUlang,
            "komite_1" => "Belum Lunas",
            "kartu" => null,
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