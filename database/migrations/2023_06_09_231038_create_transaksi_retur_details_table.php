<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_retur_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_retur_id');
            $table->unsignedBigInteger('telur_id');
            $table->unsignedBigInteger('telur_stok_id');
            $table->unsignedBigInteger('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_retur_details');
    }
};
