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

        
        Schema::create('temptests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // $table->unsignedBigInteger('testcategory_id')->nullable;
            // $table->foreign('testcategory_id')->references('id')->on('testcategories')->onDelete('cascade');
            $table->timestamps();
        });
        
        // Schema::create('testcategories', function (Blueprint $table) {
        //     $table->unsignedBigInteger('temptest_id');
        //     $table->unsignedBigInteger('category_id');
        //     $table->primary(['temptest_id', 'category_id']);
        //     $table->foreign('temptest_id')->references('id')->on('temptests')->onDelete('cascade');
        //     $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temptests');
    }
};
