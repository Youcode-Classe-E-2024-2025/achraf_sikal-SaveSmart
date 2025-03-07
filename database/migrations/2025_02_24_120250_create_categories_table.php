<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['income', 'expense']);
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        foreach (['Food', 'Healthcare', 'Rent', 'Education', 'Salary', 'Savings', 'Entertainment'] as $value) {
            if ($value !== 'Salary') {
                DB::table('categories')->insert(['name'=> $value,'type'=> 'expense']);
            }
            else {
                DB::table('categories')->insert(['name'=> $value,'type'=> 'income']);
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
