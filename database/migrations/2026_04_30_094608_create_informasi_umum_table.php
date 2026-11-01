<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informasi_umum', function (Blueprint $table) {
            $table->id('id_informasi');
            $table->string('judul');
            $table->text('isi_informasi');
            $table->date('tanggal_post');
            $table->string('kategori_info')->nullable();
            $table->string('gambar_poster')->nullable();
            $table->unsignedBigInteger('id_kader')->nullable();
            $table->unsignedBigInteger('id_ketua')->nullable();
            $table->timestamps();

            $table->foreign('id_kader')->references('id_kader')->on('kader')->onDelete('set null');
            $table->foreign('id_ketua')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_umum');
    }
};
