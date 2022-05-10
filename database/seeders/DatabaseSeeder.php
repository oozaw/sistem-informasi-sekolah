<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pekerja;
use App\Models\Perwakilan;
use App\Models\Prestasi;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // \App\Models\User::factory(10)->create();
        Siswa::factory(20)->create();
        Kelas::create([
            "nama" => "12 MIA 2",
            "wali_kelas_id" => "12"
        ]);
        Kelas::factory(4)->create();
        Pekerja::factory(15)->create();
        SuratKeluar::factory(20)->create();
        SuratMasuk::factory(20)->create();
        Prestasi::factory(10)->create();
        Perwakilan::factory(9)->create();
    }
}