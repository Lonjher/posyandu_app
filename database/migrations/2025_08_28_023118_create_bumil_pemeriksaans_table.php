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
        Schema::create('bumil_pemeriksaans', function (Blueprint $table) {
            $table->id('id_bumil_pemeriksaan');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bumil_id');
            $table->string('usia_kehamilan');
            $table->string('berat_badan');
            $table->string('lila');
            $table->string('sistole_distole');
            $table->string('keluhan_lain')->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('jumlah_ttd')->nullable();
            $table->string('jadwal_ttd')->nullable();
            $table->string('komposisi_jumlah_porsi')->nullable();
            $table->string('jadwal_mt')->nullable();
            $table->boolean('ikut_kelas_bumil')->nullable();
            $table->string('edukasi')->nullable();
            $table->unsignedBigInteger('skrining_tbc_id');
            $table->foreign('user_id')->references('id_user')->on('users');
            $table->foreign('bumil_id')->references('id_user')->on('users');
            $table->foreign('skrining_tbc_id')->references('id_skrining_tbc')->on('skrining_tbcs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bumil_pemeriksaans');
    }
};
