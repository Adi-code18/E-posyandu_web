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
        Schema::create('barang_manajemen', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('nama_barang');
            $table->integer('jumlah')->default(0);
            $table->date('tanggal_masuk');
            $table->string('kategori');
            $table->decimal('harga', 15, 2)->default(0);
            $table->unsignedBigInteger('id_kader')->nullable();
            $table->unsignedBigInteger('id_ketua')->nullable();
            $table->timestamps();

            $table->foreign('id_kader')->references('id_kader')->on('kader')->onDelete('set null');
            $table->foreign('id_ketua')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_manajemen');
    }
};
