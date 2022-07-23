<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KelasFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            "tingkatan" => $this->faker->randomElement(['10', '11', '12']),
            "nama" => $this->faker->bothify('## ??? #'),
            "wali_kelas_id" => mt_rand(1, 15)
        ];
    }
}