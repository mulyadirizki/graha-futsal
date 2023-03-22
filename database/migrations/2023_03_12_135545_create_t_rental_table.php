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
        Schema::create('t_rental', function (Blueprint $table) {
            $table->char('id_rental', 10);
            $table->primary(['id_rental']);
            $table->char('id_tuser', 10);
            $table->char('id_mobil', 10);
            $table->date('tgl_rental', 10);
            $table->date('tgl_kembali', 10);
            $table->string('total_biaya', 255);
            $table->integer('cara_bayar');
            $table->timestamps();

            $table->foreign('id_tuser')->references('id_tuser')->on('t_user')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_mobil')->references('id_mobil')->on('m_mobil')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_rental');
    }
};
