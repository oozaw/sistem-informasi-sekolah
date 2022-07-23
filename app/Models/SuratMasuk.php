<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model {
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = "surat_masuk";

    public function tahunAjaran() {
        return $this->belongsTo(TahunAjaran::class, 'tahunajaran_id');
    }

    public static function updateData() {
        $id_aktif = TahunAjaran::where('status', 1)->first()->id;
        $jml = SuratMasuk::where('tahunajaran_id', $id_aktif)->count();
        TahunAjaran::where('status', 1)->update(array('jml_surat_masuk' => $jml));
    }
}