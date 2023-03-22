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
        Schema::create('m_mobil', function (Blueprint $table) {
            $table->char('id_mobil', 10);
            $table->primary(['id_mobil']);
            $table->string('nama_mobil');
            $table->string('no_pol', 30);
            $table->string('warna', 35);
            $table->date('th_mobil');
            $table->string('merk_mobil', 100);
            $table->string('img_mobil', 255);
            $table->string('harga_sewa', 100);
            $table->string('denda_sewa', 100);
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_mobil');
    }
};
