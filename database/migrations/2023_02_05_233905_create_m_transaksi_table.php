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
        Schema::create('m_transaksi', function (Blueprint $table) {
            $table->char('id_mtransaksi', 10);
            $table->string('nama_rek', 100);
            $table->string('no_rek', 50);
            $table->string('jenis_bank', 30);
            $table->primary(['id_mtransaksi']);
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
        Schema::dropIfExists('m_transaksi');
    }
};
