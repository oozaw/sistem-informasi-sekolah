<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Perwakilan extends Pivot
{
    use HasFactory;

    protected $table = 'perwakilan_prestasi';
    protected $guarded = ['id'];
}