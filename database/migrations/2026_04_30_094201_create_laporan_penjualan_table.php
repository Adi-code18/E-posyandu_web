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
        Schema::create('laporan_penjualan', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->decimal('nominal', 15, 2)->default(0);
            $table->integer('jumlah_barang')->default(0);
            $table->date('tanggal_keluar');
            $table->decimal('total_harga', 15, 2)->default(0);
            $table->unsignedBigInteger('id_barang')->nullable();
            $table->unsignedBigInteger('id_ketua')->nullable();
            $table->timestamps();

            $table->foreign('id_barang')->references('id_barang')->on('barang_manajemen')->onDelete('set null');
            $table->foreign('id_ketua')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_penjualan');
    }
};
