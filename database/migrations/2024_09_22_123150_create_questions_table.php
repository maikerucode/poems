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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->integer('correct_ans');
            $table->text('ques_body');
            $table->integer('category_id');
            // $table->integer('temptest_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // $table->foreign('temptest_id')->references('id')->on('temptests')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
