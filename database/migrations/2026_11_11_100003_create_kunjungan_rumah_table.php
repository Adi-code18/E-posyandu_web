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
        Schema::create('kunjungan_rumah', function (Blueprint $table) {
            $table->id('id_kunjungan');
            $table->string('NIK', 16);
            $table->unsignedBigInteger('id_kader')->nullable();
            $table->date('tanggal');
            $table->string('kategori_sasaran'); // Bumil KEK / Resti, Balita Masalah Gizi & Stunting, Remaja Putri Anemia, Lansia PTM
            $table->json('checklist_hasil')->nullable(); // Checklist standar ILP Kemenkes
            $table->boolean('tanda_bahaya_ditemukan')->default(false);
            $table->string('status_tindak_lanjut')->default('Edukasi & Pendampingan'); // Edukasi & Pendampingan, Kunjungan Rumah Ulang, Rujuk ke Puskesmas / Pustu
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('NIK')->references('NIK')->on('warga')->onDelete('cascade');
            $table->foreign('id_kader')->references('id_kader')->on('kader')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_rumah');
    }
};

