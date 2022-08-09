<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model {
    use HasFactory;

    protected $table = "prestasi";
    protected $guarded = ['id'];

    public function siswa() {
        return $this->belongsToMany(Siswa::class, 'perwakilan_prestasi')->using(Perwakilan::class)->withTimestamps();
    }

    public function tahunAjaran() {
        return $this->belongsTo(TahunAjaran::class, 'tahunajaran_id');
    }

    public static function getEmptyPiagam() {
        return Prestasi::whereNull('piagam')->get();
    }

    public static function updateData() {
        $id_aktif = TahunAjaran::where('status', 1)->first()->id;
        $jml = Prestasi::where('tahunajaran_id', $id_aktif)->count();
        TahunAjaran::where('status', 1)->update(array('jml_prestasi' => $jml));
    }
}