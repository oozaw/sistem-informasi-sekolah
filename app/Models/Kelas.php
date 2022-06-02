<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kelas extends Model {
    use HasFactory;

    protected $guarded = ['id'];

    public function siswa() {
        return $this->hasMany(Siswa::class);
    }

    public function wali_kelas() {
        return $this->belongsTo(Pekerja::class, 'wali_kelas_id');
        // return $this->newBelongsTo(DB::table('pekerja')->where('jabatan', 'Guru')->get(), Pekerja::class, 'wali_kelas_id', 'pekerja_id', '');
    }
}