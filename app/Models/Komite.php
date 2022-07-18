<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komite extends Model {
    use HasFactory;

    protected $table = 'komite';
    protected $guarded = ['id'];

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }
}