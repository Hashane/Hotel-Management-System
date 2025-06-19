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
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('image_url');
        });
        Schema::table('room_types', function (Blueprint $table) {
            $table->json('image_urls')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('image_url')->nullable();
        });
        Schema::table('room_types', function (Blueprint $table) {
            $table->dropColumn('image_urls');
        });
    }
};
