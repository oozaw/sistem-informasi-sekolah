<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SuratKeluarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "tujuan" => $this->faker->words(2, true),
            "no_surat" => $this->faker->numerify("###/###.##/SMAN.5.Mrg/II-2022"),
            "tgl_keluar" => $this->faker->dateTime(),
            "keterangan" => $this->faker->sentence()
        ];
    }
}