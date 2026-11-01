<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_kesehatan', function (Blueprint $table) {
            $table->id('id_lap_kesehatan');
            $table->string('jenis_laporan');
            $table->date('tanggal_dibuat');
            $table->unsignedBigInteger('id_periksa')->nullable();
            $table->unsignedBigInteger('id_ketua')->nullable();
            $table->timestamps();

            $table->foreign('id_ketua')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_kesehatan');
    }
};
