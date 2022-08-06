<?php

namespace App\Exports;

use App\Models\Komite;
use Maatwebsite\Excel\Concerns\FromCollection;

class KomiteExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Komite::all();
    }
}
