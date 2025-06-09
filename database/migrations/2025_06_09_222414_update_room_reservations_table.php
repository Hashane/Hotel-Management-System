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
        Schema::table('room_reservations', function (Blueprint $table) {
            $table->date('check_in')->after('price');
            $table->date('check_out')->after('check_in');
            $table->timestamp('checked_in_at')->nullable()->after('check_out');
            $table->timestamp('checked_out_at')->nullable()->after('checked_in_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('room_reservations', function (Blueprint $table) {
            $table->dropColumn(['check_in', 'check_out', 'checked_in_at', 'checked_out_at']);
        });
    }
};
