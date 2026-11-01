<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemeriksaan_remaja', function (Blueprint $table) {
            $table->id('id_periksa');
            $table->date('tanggal');
            $table->decimal('bb', 5, 2)->nullable();
            $table->decimal('tb', 5, 2)->nullable();
            $table->string('tensi')->nullable();
            $table->decimal('hemoglobin', 5, 2)->nullable();
            $table->decimal('gula', 5, 2)->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_remaja');
    }
};
