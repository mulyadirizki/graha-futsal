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
        Schema::create('t_fasilitas', function (Blueprint $table) {
            $table->char('id_fasilitas', 10);
            $table->char('id_lapangan', 10);
            $table->string('dsc_fasilitas');
            $table->primary(['id_fasilitas']);
            $table->timestamps();

            $table->foreign('id_lapangan')->references('id_lapangan')->on('m_lapangan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_fasilitas');
    }
};
