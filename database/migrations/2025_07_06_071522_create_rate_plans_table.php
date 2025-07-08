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
        Schema::create('rate_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('BAR, Breakfast_Included, Corporate');
            $table->string('code')->unique()->comment('BAR2025');
            $table->foreignId('parent_id')->nullable()->constrained('rate_plans');
            $table->enum('adjustment_type', ['percent', 'fixed'])->nullable();
            $table->decimal('adjustment_value', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_plans');
    }
};
