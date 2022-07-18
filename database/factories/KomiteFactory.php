<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KomiteFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'siswa_id' => $this->faker->randomNumber(1, true),
        ];
    }
}