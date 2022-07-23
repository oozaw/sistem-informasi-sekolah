<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model {
    use HasFactory;

    protected $table = 'tahun_ajaran';
    protected $guarded = ['id'];

    public function prestasi() {
        return $this->hasMany(Prestasi::class, 'tahunajaran_id');
    }

    public function suratMasuk() {
        return $this->hasMany(SuratMasuk::class, 'tahunajaran_id');
    }

    public function suratKeluar() {
        return $this->hasMany(SuratKeluar::class, 'tahunajaran_id');
    }
}