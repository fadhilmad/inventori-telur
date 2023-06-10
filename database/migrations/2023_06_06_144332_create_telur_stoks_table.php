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
        Schema::create('telur_stoks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('telur_id');
            $table->unsignedBigInteger('transaksi_masuk_id');
            $table->unsignedBigInteger('transaksi_masuk_detail_id');
            $table->string('satuan_besar');
            $table->string('satuan_kecil');
            $table->integer('masuk');
            $table->integer('keluar');
            $table->integer('ready');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telur_stoks');
    }
};
