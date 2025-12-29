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
        Schema::table('produits', function (Blueprint $table) {
            $table->boolean('est_gratuit')->default(false)->after('reduction');
            $table->integer('quantite_limitee')->nullable()->after('est_gratuit');
            $table->boolean('est_offre_weekend')->default(false)->after('quantite_limitee');
            $table->timestamp('date_debut_offre')->nullable()->after('est_offre_weekend');
            $table->timestamp('date_fin_offre')->nullable()->after('date_debut_offre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->dropColumn([
                'est_gratuit',
                'quantite_limitee',
                'est_offre_weekend',
                'date_debut_offre',
                'date_fin_offre'
            ]);
        });
    }
};