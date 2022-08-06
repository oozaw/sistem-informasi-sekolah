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
        // User::factory(10)->create();
        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin-sim'),
            'dec_password' => encrypt('admin-sim'),
            'role' => '1'
        ]);
        Siswa::factory(20)->create();
        Kelas::create([
            "tingkatan" => "12",
            "nama" => "12 MIA 2",
            "wali_kelas_id" => "12"
        ]);
        Kelas::factory(4)->create();
        Pekerja::factory(15)->create();
        Pekerja::create([
            'nama' => 'Kepala Sekolah',
            'email' => '',
            'no_hp' => '',
            'jabatan' => 'Kepala Sekolah',
            'gender' => '',
            'tempat_tinggal' => '',
            'foto_profil' => ''
        ]);
        SuratKeluar::factory(20)->create();
        SuratMasuk::factory(20)->create();
        Prestasi::factory(10)->create();
        Perwakilan::factory(9)->create();
        Komite::factory(3)->create();
        TahunAjaran::create([
            'tahun_ajaran' => '2019/2021',
            'status' => '0',
            'jml_siswa' => '487',
            'jml_siswa_baru' => '156',
            'jml_siswa_keluar' => '2',
            'jml_siswa_lulus' => '150',
            'jml_prestasi' => '45',
            'jml_pegawai' => '43',
            'jml_surat_masuk' => '49',
            'jml_surat_keluar' => '62'
        ]);
        TahunAjaran::create([
            'tahun_ajaran' => '2020/2021',
            'status' => '0',
            'jml_siswa' => '516',
            'jml_siswa_baru' => '176',
            'jml_siswa_keluar' => '0',
            'jml_siswa_lulus' => '130',
            'jml_prestasi' => '50',
            'jml_pegawai' => '39',
            'jml_surat_masuk' => '55',
            'jml_surat_keluar' => '25'
        ]);
        TahunAjaran::create([
            'tahun_ajaran' => '2021/2022',
            'status' => '0',
            'jml_siswa' => '490',
            'jml_siswa_baru' => '146',
            'jml_siswa_keluar' => '2',
            'jml_siswa_lulus' => '180',
            'jml_prestasi' => '32',
            'jml_pegawai' => '40',
            'jml_surat_masuk' => '50',
            'jml_surat_keluar' => '65'
        ]);
        TahunAjaran::create([
            'tahun_ajaran' => '2022/2023',
            'status' => '1',
            'nominal_daftar_ulang' => 'Rp. 420.000',
            'jml_siswa' => '420',
            'jml_siswa_baru' => '186',
            'jml_siswa_keluar' => '4',
            'jml_siswa_lulus' => '160',
            'jml_prestasi' => '30',
            'jml_pegawai' => '42',
            'jml_surat_masuk' => '70',
            'jml_surat_keluar' => '45'
        ]);
    }
}