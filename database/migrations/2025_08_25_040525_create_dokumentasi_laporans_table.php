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
        Schema::create('dokumentasi_laporans', function (Blueprint $table) {
            $table->id('id_dokumentasi');
            $table->string('photo_path');
            $table->unsignedBigInteger('laporan_id');
            $table->foreign('laporan_id')->references('id_laporan')->on('laporan_kegiatans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentasi_laporans');
    }
};
