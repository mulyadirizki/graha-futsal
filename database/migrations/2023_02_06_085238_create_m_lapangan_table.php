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
        Schema::create('m_lapangan', function (Blueprint $table) {
            $table->char('id_lapangan', 10);
            $table->char('kode_lapangan', 10);
            $table->string('dsc_lapangan', 50);
            $table->string('tipe_lapangan', 30);
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->char('status_lapangan', 2);
            $table->string('harga_lapangan', 30);
            $table->primary(['id_lapangan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_lapangan');
    }
};
