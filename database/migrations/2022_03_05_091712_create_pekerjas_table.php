<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekerja', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_hp')->unique();
            $table->string('nip')->unique()->nullable();
            $table->string('jabatan');
            $table->string('gender');
            $table->string('tempat_tinggal');
            $table->string('foto_profil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pekerja');
    }
}