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
        // create the new column you want to add
        // 'users' is the name of the table
        Schema::table('users',function($table){
            $table->string('favoriteColor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('users',function($table){
            $table->dropColumn('favoriteColor');
        });
    }
};
