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
        Schema::create('jadwal_posyandu', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->date('tanggal_pelaksanaan');
            $table->text('kegiatan_pelaksanaan')->nullable();
            $table->string('status_pelaksanaan')->default('belum');
            $table->unsignedBigInteger('id_kader')->nullable();
            $table->string('id_balita')->nullable();
            $table->timestamps();

            $table->foreign('id_kader')->references('id_kader')->on('kader')->onDelete('set null');
            $table->foreign('id_balita')->references('NIK')->on('warga')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_posyandu');
    }
};
