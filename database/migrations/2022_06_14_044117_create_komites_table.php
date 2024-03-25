<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomitesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('komite', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('siswa_id')->unique();
            $table->string('bebas1')->default('0');
            $table->string('bebas2')->default('0');
            $table->string('daftar_ulang')->default('0');
            $table->string('komite_1')->default('Belum Lunas');
            // $table->string('kartu')->default(null)->nullable()->after('komite_1');
            $table->string('1')->default('Belum Lunas');
            $table->string('2')->default('Belum Lunas');
            $table->string('3')->default('Belum Lunas');
            $table->string('4')->default('Belum Lunas');
            $table->string('5')->default('Belum Lunas');
            $table->string('6')->default('Belum Lunas');
            $table->string('7')->default('Belum Lunas');
            $table->string('8')->default('Belum Lunas');
            $table->string('9')->default('Belum Lunas');
            $table->string('10')->default('Belum Lunas');
            $table->string('11')->default('Belum Lunas');
            $table->string('12')->default('Belum Lunas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('komite');
    }
}
