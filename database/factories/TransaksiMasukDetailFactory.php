<?php

namespace Database\Factories;

use App\Models\Telur;
use App\Models\TransaksiMasuk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransaksiMasukDetail>
 */
class TransaksiMasukDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaksi_masuk_id' => TransaksiMasuk::factory(),
            'telur_id' => Telur::factory()
        ];
    }
}
