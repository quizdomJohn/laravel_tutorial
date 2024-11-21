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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->longText('body');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');//'foreignId is to associate the two tables. 'user' is the name of the table that we want to look up.'id' is the name of the column.'constrained is so the Lravel doesn't let you create a post if the id of the user doesn't exist.'onDelete(cascade) is to delete also all the posts of a user that deletes his account
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
