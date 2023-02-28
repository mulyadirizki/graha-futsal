<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_transaksi', function (Blueprint $table) {
            $table->char('id_transaksi', 10);
            $table->char('id_tuser', 10);
            $table->char('id_booking', 10);
            $table->char('id_mtransaksi', 10);
            $table->date('tgl_transaksi');
            $table->string('bukti_transaksi');
            $table->primary(['id_transaksi']);
            $table->timestamps();

            $table->foreign('id_tuser')->references('id_tuser')->on('t_user');
            $table->foreign('id_booking')->references('id_booking')->on('m_booking');
            $table->foreign('id_mtransaksi')->references('id_mtransaksi')->on('m_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_transaksi');
    }
};
