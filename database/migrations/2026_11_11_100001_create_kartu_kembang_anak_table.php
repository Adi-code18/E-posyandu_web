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
        Schema::create('kartu_kembang_anak', function (Blueprint $table) {
            $table->id('id_kka');
            $table->string('NIK', 16);
            $table->unsignedBigInteger('id_kader')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->date('tanggal_pemeriksaan');
            $table->unsignedTinyInteger('usia_bulan');
            
            // 7 Aspek Perkembangan KKA Kemenkes (0 - 72 Bulan)
            $table->boolean('gerak_kasar')->default(true);
            $table->boolean('gerak_halus')->default(true);
            $table->boolean('komunikasi_pasif')->default(true);
            $table->boolean('komunikasi_aktif')->default(true);
            $table->boolean('kecerdasan')->default(true);
            $table->boolean('menolong_diri_sendiri')->default(true);
            $table->boolean('tingkah_laku_sosial')->default(true);

            // Indikator Garis Merah & Rujukan
            $table->boolean('capai_garis_merah')->default(false);
            $table->unsignedTinyInteger('bulan_tidak_capai_beruntun')->default(0);
            $table->string('status_rujuk')->default('Normal'); // Normal, Perlu Pemantauan, Rujuk ke Puskesmas
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('NIK')->references('NIK')->on('warga')->onDelete('cascade');
            $table->foreign('id_kader')->references('id_kader')->on('kader')->onDelete('set null');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_kembang_anak');
    }
};

