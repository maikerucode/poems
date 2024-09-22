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
        Schema::create('finaltests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('temptest_id');
            $table->foreign('temptest_id')->references('id')->on('temptests')->onDelete('cascade');
            $table->string('status')->nullable();
            $table->boolean('is_graded')->nullable();
            $table->integer('score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finaltests');
    }
};
