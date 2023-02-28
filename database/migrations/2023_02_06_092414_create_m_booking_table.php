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
        Schema::create('m_booking', function (Blueprint $table) {
            $table->char('id_booking', 10);
            $table->char('id_tuser', 10);
            $table->char('id_lapangan', 10);
            $table->date('tgl_booking');
            $table->time('jam_mulai');
            $table->time('jam_berakhir');
            $table->char('status', 2);
            $table->string('total_biaya', 50);
            $table->primary(['id_booking']);
            $table->timestamps();

            $table->foreign('id_tuser')->references('id_tuser')->on('t_user');
            $table->foreign('id_lapangan')->references('id_lapangan')->on('m_lapangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_booking');
    }
};
