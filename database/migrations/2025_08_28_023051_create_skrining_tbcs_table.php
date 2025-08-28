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
        Schema::create('skrining_tbcs', function (Blueprint $table) {
            $table->id('id_skrining_tbc');
            $table->boolean('batuk_terus_menerus');
            $table->boolean('demam_lebih_dari_2_minggu');
            $table->boolean('berat_badan_turun_tanpa_sebab_jelas');
            $table->boolean('kontak_dengan_orang_terinfeksi_tbc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skrining_tbcs');
    }
};
