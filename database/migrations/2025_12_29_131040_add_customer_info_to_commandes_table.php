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
        Schema::table('commandes', function (Blueprint $table) {
            $table->string('nom_client')->nullable();
            $table->string('email_client')->nullable();
            $table->string('telephone_client')->nullable();
            $table->string('adresse_livraison')->nullable();
            $table->string('ville_livraison')->nullable();
            $table->string('code_postal_livraison')->nullable();
            $table->string('instructions_livraison')->nullable();
            $table->string('mode_livraison')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn([
                'nom_client',
                'email_client',
                'telephone_client',
                'adresse_livraison',
                'ville_livraison',
                'code_postal_livraison',
                'instructions_livraison',
                'mode_livraison'
            ]);
        });
    }
};