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
        Schema::create('voting_booths', function (Blueprint $table) {
            $table->id();
        $table->string('name'); // Contoh: "Bilik 01 (Lab Komputer)"
        $table->string('location')->nullable(); // Contoh: "Gedung A"
        $table->string('access_code')->unique(); // Kode unik untuk login bilik
        $table->boolean('is_active')->default(true); // Status Aktif/Nonaktif
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voting_booths');
    }
};
