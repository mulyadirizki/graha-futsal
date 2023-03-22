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
        Schema::create('t_user', function (Blueprint $table) {
            $table->char('id_tuser', 10);
            $table->string('nik', 20);
            $table->string('nama', 100);
            $table->date('tgl_lahir');
            $table->integer('j_kel');
            $table->string('no_hp', 15);
            $table->string('pekerjaan', 35);
            $table->text('alamat');
            $table->primary(['id_tuser']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_user');
    }
};
