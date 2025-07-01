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
        Schema::table('room_types', function (Blueprint $table) {
            $table->foreignId('room_category_id')
                ->after('id')
                ->constrained('room_categories')
                ->onDelete('cascade');
            $table->decimal('size', 6, 2)->after('capacity')->nullable();
            $table->string('bed_type')->after('size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('room_types', function (Blueprint $table) {
            $table->dropForeign(['room_category_id']);
            $table->dropColumn(['room_category_id', 'size', 'bed_type']);
        });
    }
};
