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
        Schema::create('m_rekening', function (Blueprint $table) {
            $table->char('id_rek', 10);
            $table->primary(['id_rek']);
            $table->string('nama_rek', 100);
            $table->string('no_rek', 50);
            $table->string('jenis_bank', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_rekening');
    }
};
