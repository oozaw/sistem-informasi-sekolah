<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
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