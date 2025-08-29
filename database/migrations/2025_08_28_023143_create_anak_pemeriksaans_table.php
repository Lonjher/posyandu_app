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
        Schema::create('anak_pemeriksaans', function (Blueprint $table) {
            $table->id('id_anak_pemeriksaan');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('anak_id');
            $table->string('bb');
            $table->string('kesimpulan_hasil_bb');
            $table->string('kesimpulan_hasil_pengukuran_bb');
            $table->string('tb');
            $table->string('kesimpulan_hasil_tb');
            $table->string('kesimpulan_hasil_pengukuran_imt');
            $table->string('lingkar_kepala');
            $table->string('kesimpulan_lk');
            $table->string('lingkar_lengan_atas');
            $table->string('kesimpulan_lla');
            $table->string('asi_eksklusif')->nullable();
            $table->string('mp_asi')->nullable();
            $table->string('imunisasi');
            $table->string('vitamin_a')->nullable();
            $table->string('obat_cacing')->nullable();
            $table->string('mt_pangan_lokal')->nullable();
            $table->string('gejala_sakit')->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('skrining_tbc_id');
            $table->foreign('user_id')->references('id_user')->on('users');
            $table->foreign('anak_id')->references('id_user')->on('users');
            $table->foreign('skrining_tbc_id')->references('id_skrining_tbc')->on('skrining_tbcs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anak_pemeriksaans');
    }
};
