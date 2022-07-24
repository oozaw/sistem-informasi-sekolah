<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasuksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('tahunajaran_id');
            $table->string("asal");
            $table->string("nomor");
            $table->string("kode_tujuan");
            $table->string("instansi_asal");
            $table->string("bulan");
            $table->string("tahun");
            $table->date("tgl_masuk");
            $table->string("keterangan")->nullable();
            $table->string("file_surat")->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('surat_masuk');
    }
}