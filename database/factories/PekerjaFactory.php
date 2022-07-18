<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PekerjaFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            "nama" => $this->faker->name(),
            "email" => $this->faker->email(),
            "no_hp" => $this->faker->phoneNumber(),
            "nip" => $this->faker->randomNumber(9, true),
            "jabatan" => $this->faker->randomElement(['Guru', 'Staf Tata Usaha', 'Staf Lainnya']),
            "gender" => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            "tempat_tinggal" => $this->faker->address(),
            "foto_profil" => ""
        ];
    }
}