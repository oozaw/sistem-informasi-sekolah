<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Komite;
use App\Models\Siswa;
use App\Models\Pekerja;
use App\Models\Prestasi;
use App\Models\Perwakilan;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call([
            UserSeeder::class,
            SiswaSeeder::class,
            KelasSeeder::class,
            PekerjaSeeder::class,
            SuratKeluarSeeder::class,
            SuratMasukSeeder::class,
            PrestasiSeeder::class,
            PerwakilanSeeder::class,
            KomiteSeeder::class,
            TahunAjaranSeeder::class,
        ]);
    }
}