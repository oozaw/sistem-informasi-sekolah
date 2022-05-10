<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerwakilansTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('perwakilan_prestasi', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('siswa_id');
            $table->foreignId('prestasi_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('perwakilan_prestasi');
    }
}