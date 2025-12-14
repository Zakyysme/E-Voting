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
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('vice_name')->nullable()->after('name'); 
        $table->string('vice_photo')->nullable()->after('photo_url');
    });
}

public function down(): void
{
    Schema::table('candidates', function (Blueprint $table) {
        $table->dropColumn(['vice_name', 'vice_photo']);
    });
}
};
