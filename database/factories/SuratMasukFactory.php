<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SuratMasukFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            "tahunajaran_id" => $this->faker->randomElement(['1', '2']),
            "asal" => $this->faker->words(2, true),
            "nomor" => $this->faker->numerify('###'),
            "kode_tujuan" => "SMAN.5.Mrg",
            "instansi_asal" => $this->faker->numerify("SMAN.#.Mrg"),
            "bulan" => "II",
            "tahun" => "2022",
            "tgl_masuk" => $this->faker->date(),
            "keterangan" => $this->faker->sentence(),
            "file_surat" => $this->faker->sentence()
        ];
    }
}