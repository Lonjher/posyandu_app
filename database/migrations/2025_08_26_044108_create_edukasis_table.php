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
        Schema::create('edukasis', function (Blueprint $table) {
            $table->id('id_edukasi');
            $table->string('judul');
            $table->string('gambar');
            $table->unsignedBigInteger('user_id');
            $table->enum('kategori', ['bumil', 'anak', 'lansia', 'umum']);
            $table->foreign('user_id')->references('id_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edukasis');
    }
};
