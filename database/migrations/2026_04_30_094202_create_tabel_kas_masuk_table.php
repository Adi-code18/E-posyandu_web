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
        Schema::create('tabel_kas_masuk', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->decimal('total_dana_dikelola', 15, 2)->default(0);
            $table->string('status_laporan')->default('pending');
            $table->date('tanggal_terima_dana');
            $table->string('nama_sumber');
            $table->text('ket_penggunaan_dana')->nullable();
            $table->unsignedBigInteger('id_ketua')->nullable();
            $table->timestamps();

            $table->foreign('id_ketua')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_kas_masuk');
    }
};
