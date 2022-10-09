<?php

namespace Database\Seeders;

use App\Models\Komite;
use Illuminate\Database\Seeder;

class KomiteSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Komite::factory(3)->create();
    }
}