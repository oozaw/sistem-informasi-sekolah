<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PerwakilanFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            "siswa_id" => $this->faker->randomNumber(1, true),
            "prestasi_id" => $this->faker->randomNumber(1, true)
        ];
    }
}