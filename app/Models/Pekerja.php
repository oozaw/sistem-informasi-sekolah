<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerja extends Model
{
    use HasFactory;

    protected $table = "pekerja";
    protected $guarded = ['id'];

    public function kelas() {
        return $this->hasOne(Kelas::class, 'wali_kelas_id');
    }
}