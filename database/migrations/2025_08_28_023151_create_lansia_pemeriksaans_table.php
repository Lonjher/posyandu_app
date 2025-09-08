<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lansia_pemeriksaans', function (Blueprint $table) {
            $table->id('id_lansia_pemeriksaan');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lansia_id');
            $table->string('bb');
            $table->string('tb');
            $table->string('imt');
            $table->string('lingkar_perut');
            $table->string('tekanan_darah');
            $table->string('gula_darah');
            $table->string('mata_kanan');
            $table->string('mata_kiri');
            $table->string('telinga_kanan');
            $table->string('telinga_kiri');
            $table->string('usia');
            $table->boolean('menggunakan_alat_kontrasepsi');
            $table->string('diagnosa')->nullable();
            $table->string('edukasi')->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('skrining_tbc_id');
            $table->foreign('user_id')->references('id_user')->on('users');
            $table->foreign('lansia_id')->references('id_user')->on('users');
            $table->foreign('skrining_tbc_id')->references('id_skrining_tbc')->on('skrining_tbcs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lansia_pemeriksaans');
    }
};
