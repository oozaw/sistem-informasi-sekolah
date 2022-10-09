<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // User::factory(10)->create();
        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin-sim'),
            'dec_password' => encrypt('admin-sim'),
            'role' => '1'
        ]);
    }
}