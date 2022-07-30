<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunAjaransTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tahun_ajaran', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("tahun_ajaran");
            $table->string("status");
            $table->string('nominal_daftar_ulang')->default('0');
            $table->string("jml_siswa_baru")->nullable();
            $table->string("jml_siswa")->nullable();
            $table->string("jml_siswa_keluar")->nullable();
            $table->string("jml_siswa_lulus")->nullable();
            $table->string("jml_prestasi")->nullable();
            $table->string("jml_pegawai")->nullable();
            $table->string("jml_surat_masuk")->nullable();
            $table->string("jml_surat_keluar")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tahun_ajaran');
    }
}