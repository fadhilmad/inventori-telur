<?php

namespace Database\Seeders;

use App\Models\SatuanBesar;
use App\Models\SatuanKecil;
use App\Models\User;
use App\Models\Suplier;
use App\Models\Telur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppInitializeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create(['username' => 'admin', 'name' => 'Administrator', 'role' => 'admin']);

        // Suplier::factory()->create(['name' => 'Peternak']);

        // $satuanBesar = SatuanBesar::factory()->create(['name' => 'Ikat']);
        // $satuanKecil = SatuanKecil::factory()->create(['name' => 'KG']);

        // Telur::factory(3)->create([
        //     'satuan_besar_id' => $satuanBesar->id,
        //     'satuan_kecil_id' => $satuanKecil->id
        // ]);
    }
}
