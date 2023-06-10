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
        Schema::create('transaksi_masuk_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_masuk_id');
            $table->unsignedBigInteger('telur_id');
            $table->string('satuan_besar');
            $table->integer('qty_satuan_besar');
            $table->string('satuan_kecil');
            $table->integer('isi_satuan_kecil');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('transaksi_masuk_id')->references('id')->on('transaksi_masuk')->onDelete('cascade');
            $table->foreign('telur_id')->references('id')->on('telurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_masuk_details');
    }
};
