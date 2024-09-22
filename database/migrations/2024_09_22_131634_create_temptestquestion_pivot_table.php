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
        Schema::create('temptestquestions', function (Blueprint $table) {
            $table->unsignedBigInteger('temptest_id');
            $table->unsignedBigInteger('question_id');
            $table->primary(['temptest_id', 'question_id']);
            $table->foreign('temptest_id')->references('id')->on('temptests')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->timestamps();
        });
    }
};
