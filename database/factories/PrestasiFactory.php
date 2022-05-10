<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PrestasiFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            "nama" => $this->faker->sentence(3, true),
            "jenis" => $this->faker->randomElement(["Individu", "Kelompok"]),
            "capaian" => $this->faker->numerify("Juara #"),
            "tanggal" => $this->faker->date('d M Y'),
            "tingkat" => $this->faker->randomElement(["Kabupaten/Kota", "Provinsi", "Nasional", "Internasional"]),
            "bidang" => $this->faker->randomElement(['Akademik', 'Non Akademik']),
            "tahun" => $this->faker->year(),
        ];
    }
}