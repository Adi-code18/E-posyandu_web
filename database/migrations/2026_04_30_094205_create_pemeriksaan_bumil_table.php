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
        Schema::create('pemeriksaan_bumil', function (Blueprint $table) {
            $table->id('id_periksa');
            $table->date('tanggal');
            $table->string('usia_kehamilan')->nullable()->comment('Usia Kehamilan');
            $table->decimal('bb', 5, 2)->nullable()->comment('Berat Badan (kg)');
            $table->decimal('tb', 5, 2)->nullable()->comment('Tinggi Badan (cm)');
            $table->decimal('la', 5, 2)->nullable()->comment('Lingkar Lengan Atas (cm)');
            $table->decimal('lp', 5, 2)->nullable()->comment('Lingkar Perut (cm)');
            $table->string('tensi')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_bumil');
    }
};
