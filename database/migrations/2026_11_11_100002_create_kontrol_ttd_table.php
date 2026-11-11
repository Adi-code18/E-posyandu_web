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
        Schema::create('kontrol_ttd', function (Blueprint $table) {
            $table->id('id_ttd');
            $table->string('NIK', 16);
            $table->unsignedBigInteger('id_kader')->nullable();
            $table->date('tanggal_konsumsi');
            $table->unsignedSmallInteger('jumlah_tablet')->default(1);
            $table->enum('status_sasaran', ['Ibu Hamil', 'Remaja Putri'])->default('Ibu Hamil');
            $table->decimal('kadar_hb', 4, 1)->nullable(); // contoh: 11.2 gr/dl
            $table->boolean('status_anemia')->default(false); // True jika Hb < 12 gr/dl
            $table->string('efek_samping')->nullable(); // Mual, Konstipasi, Tinja Gelap, Tidak Ada
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
        Schema::dropIfExists('kontrol_ttd');
    }
};

