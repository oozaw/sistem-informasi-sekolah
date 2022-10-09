<?php

namespace Database\Seeders;

use App\Models\Perwakilan;
use Illuminate\Database\Seeder;

class PerwakilanSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Perwakilan::factory(9)->create();
    }
}