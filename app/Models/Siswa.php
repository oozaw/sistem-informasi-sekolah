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

    public function prestasi() {
        return $this->belongsToMany(Prestasi::class, 'perwakilan_prestasi')->withTimestamps();
    }
}