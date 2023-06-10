<?php

namespace Database\Factories;

use App\Models\Suplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransaksiMasuk>
 */
class TransaksiMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal_masuk' => fake()->date(),
            'suplier_id' => Suplier::factory()->create()->id,
            'insert_stok' => 'belum'
        ];
    }
}
