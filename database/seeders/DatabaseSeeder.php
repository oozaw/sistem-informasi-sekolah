<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pekerja;
use App\Models\Prestasi;
use App\Models\Perwakilan;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // User::factory(10)->create();
        User::create([
            'username' => 'wahyuady',
            'password' => bcrypt('password'),
            'role' => '1'
        ]);
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