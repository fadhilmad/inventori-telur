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
        Schema::create('telurs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('satuan_besar_id');
            $table->integer('isi_satuan_kecil');
            $table->unsignedBigInteger('satuan_kecil_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('satuan_besar_id')->references('id')->on('satuan_besar')->onDelete('cascade');
            $table->foreign('satuan_kecil_id')->references('id')->on('satuan_kecil')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telurs');
    }
};
