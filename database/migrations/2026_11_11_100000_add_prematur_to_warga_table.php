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
        Schema::table('warga', function (Blueprint $table) {
            $table->boolean('is_prematur')->default(false)->after('status');
            $table->unsignedTinyInteger('usia_kehamilan_minggu')->nullable()->after('is_prematur');
            $table->string('fcm_token')->nullable()->after('usia_kehamilan_minggu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            $table->dropColumn(['is_prematur', 'usia_kehamilan_minggu', 'fcm_token']);
        });
    }
};

