<?php

namespace Database\Seeders;

use App\Models\Pekerja;
use Illuminate\Database\Seeder;

class PekerjaSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Pekerja::factory(15)->create();
        Pekerja::create([
            'nama' => 'HENANG PRIYANTO, S.Pd., M.Si.',
            'nip' => '19830210 200501 1005',
            'email' => '',
            'no_hp' => '',
            'jabatan' => 'Kepala Sekolah',
            'gender' => 'Laki-laki',
            'tempat_tinggal' => 'Desa Meranti',
            'foto_profil' => ''
        ]);
    }
}