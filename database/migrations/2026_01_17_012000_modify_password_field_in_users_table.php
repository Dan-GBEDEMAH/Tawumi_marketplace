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
        // Modify the password column to allow nullable temporarily, then update existing records
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
        });
        
        // Update any existing users that might have empty passwords
        \Illuminate\Support\Facades\DB::statement("UPDATE users SET password = NULL WHERE password = '' OR password IS NULL");
        
        // Now make it non-nullable again with a default value
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->default(null)->change();
        });
    }
};