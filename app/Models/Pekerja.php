<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerja extends Model {
    use HasFactory;

    protected $table = "pekerja";
    protected $guarded = ['id'];

    public function kelas() {
        return $this->hasOne(Kelas::class, 'wali_kelas_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'pegawai_id');
    }

    public static function updateData() {
        $jml = Pekerja::all()->count();
        TahunAjaran::where('status', 1)->update(array('jml_pegawai' => $jml));
    }
}