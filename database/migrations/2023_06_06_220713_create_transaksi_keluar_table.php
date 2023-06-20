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
        Schema::create('transaksi_keluar', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_keluar');
            $table->string('tujuan')->nullable();
            $table->enum('status', ['dikirim', 'belum'])->default('belum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_keluar');
    }
};
