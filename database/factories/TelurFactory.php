<?php

namespace Database\Factories;

use App\Models\SatuanBesar;
use App\Models\SatuanKecil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Telur>
 */
class TelurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'satuan_besar_id' => SatuanBesar::factory()->create()->id,
            'isi_satuan_kecil' => fake()->numberBetween(1, 100),
            'satuan_kecil_id' => SatuanKecil::factory()->create()->id
        ];
    }
}
