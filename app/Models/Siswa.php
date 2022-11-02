<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model {
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = "siswa";

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    public static function getProfil($id) {
        $profile = Siswa::where('id', $id)->pluck('foto_profil')->first();
        return $profile;
    }

    public function prestasi() {
        return $this->belongsToMany(Prestasi::class, 'perwakilan_prestasi')->using(Perwakilan::class)->withTimestamps();
    }

    public function komite() {
        return $this->hasOne(Komite::class);
    }

    public static function getSiswaKelas($kelas_id) {
        $jml = Siswa::where('kelas_id', $kelas_id)->get();
        return $jml;
    }
}