<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('savings_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('family_id')->nullable()->constrained('families')->onDelete('cascade');
            $table->string('name');
            $table->decimal('target_amount', 10, 2);
            $table->decimal('current_amount', 10, 2)->default(0);
            $table->date('deadline')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('savings_goals');
    }
};
