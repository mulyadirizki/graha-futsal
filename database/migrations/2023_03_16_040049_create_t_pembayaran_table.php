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
        Schema::create('t_pembayaran', function (Blueprint $table) {
            $table->char('id_pembayaran', 10);
            $table->primary(['id_pembayaran']);
            $table->char('id_tuser', 10);
            $table->char('id_rental', 10);
            $table->char('id_rek', 10);
            $table->date('tgl_pembayaran');
            $table->string('bukti_transaksi', 255);
            $table->timestamps();

            $table->foreign('id_tuser')->references('id_tuser')->on('t_user')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_rental')->references('id_rental')->on('t_rental')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_rek')->references('id_rek')->on('m_rekening')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pembayaran');
    }
};
