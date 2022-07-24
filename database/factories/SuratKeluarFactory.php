<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SuratKeluarFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            "tahunajaran_id" => $this->faker->randomElement(['1', '2']),
            "tujuan" => $this->faker->words(2, true),
            "nomor" => $this->faker->numerify('###'),
            "kode_tujuan" => $this->faker->numerify("###.#"),
            "instansi_asal" => "SMAN.5.Mrg",
            "bulan" => "II",
            "tahun" => "2021",
            "tgl_keluar" => $this->faker->date(),
            "keterangan" => $this->faker->sentence(),
            "file_surat" => $this->faker->sentence()
        ];
    }
}