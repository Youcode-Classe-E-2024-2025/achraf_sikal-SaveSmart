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
        Schema::table('budget_optimizations', function (Blueprint $table) {
            $table->decimal('income', 10, 2)->nullable()->default(0)->change();
            $table->decimal('needs', 10, 2)->nullable()->default(0)->change();
            $table->decimal('wants', 10, 2)->nullable()->default(0)->change();
            $table->decimal('savings', 10, 2)->nullable()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('budget_optimizations', function (Blueprint $table) {
            $table->decimal('income', 10, 2)->nullable(false)->default(null)->change();
            $table->decimal('needs', 10, 2)->nullable(false)->default(null)->change();
            $table->decimal('wants', 10, 2)->nullable(false)->default(null)->change();
            $table->decimal('savings', 10, 2)->nullable(false)->default(null)->change();
        });
    }
};
