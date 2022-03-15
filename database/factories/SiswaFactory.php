<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nama" => $this->faker->name(),
            "gender" => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            "nisn" => $this->faker->randomNumber(9, true),
            "nis" => $this->faker->randomNumber(6, true),
            "kelas_id" => mt_rand(1, 4) 
        ];
    }
}