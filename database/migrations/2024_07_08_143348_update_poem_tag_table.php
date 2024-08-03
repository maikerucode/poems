<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePoemTagTable extends Migration
{
    public function up()
    {
        Schema::table('poem_tag', function (Blueprint $table) {
            // First, drop the existing foreign key constraints
            $table->dropForeign(['poem_id']);
            $table->dropForeign(['tag_id']);
            
            // Now, add the foreign key constraints with cascade on delete
            $table->foreign('poem_id')->references('id')->on('poems')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('poem_tag', function (Blueprint $table) {
            // Rollback changes by dropping the foreign key constraints with cascade
            $table->dropForeign(['poem_id']);
            $table->dropForeign(['tag_id']);
            
            // Add the original foreign key constraints back without cascade
            $table->foreign('poem_id')->references('id')->on('poems');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }
}
