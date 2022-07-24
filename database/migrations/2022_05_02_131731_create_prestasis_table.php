<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestasisTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('tahunajaran_id');
            $table->string("nama");
            $table->string("jenis");
            $table->string("capaian");
            $table->date("tanggal");
            $table->string("tingkat");
            $table->string("bidang");
            $table->year("tahun");
            $table->string("piagam")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('prestasi');
    }
}