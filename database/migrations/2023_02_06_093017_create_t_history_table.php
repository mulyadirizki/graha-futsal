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
        Schema::create('t_history', function (Blueprint $table) {
            $table->char('id_history', 10);
            $table->char('id_transaksi', 10);
            $table->primary(['id_history']);
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id_transaksi')->on('t_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_history');
    }
};
