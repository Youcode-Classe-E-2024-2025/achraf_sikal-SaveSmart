<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['PDF', 'CSV']);
            $table->string('file_path');
            $table->timestamp('generated_at')->useCurrent();
        });
    }

    public function down() {
        Schema::dropIfExists('reports');
    }
};
