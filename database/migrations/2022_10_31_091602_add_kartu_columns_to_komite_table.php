<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKartuColumnsToKomiteTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('komite', function (Blueprint $table) {
            $table->string('kartu')->default(null)->nullable()->after('komite_1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('komite', function (Blueprint $table) {
            $table->dropColumn('kartu');
        });
    }
}