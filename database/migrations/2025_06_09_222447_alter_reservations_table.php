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
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['check_in', 'check_out', 'checked_in_at', 'checked_out_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->date('checked_in_at')->nullable();
            $table->date('checked_out_at')->nullable();
        });
    }
};
