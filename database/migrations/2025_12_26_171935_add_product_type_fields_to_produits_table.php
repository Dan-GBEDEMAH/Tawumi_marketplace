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
            $table->boolean('est_nouveaute')->default(false)->after('image_produit');
            $table->boolean('est_offre')->default(false)->after('est_nouveaute');
            $table->decimal('reduction', 5, 2)->nullable()->after('est_offre'); // Pourcentage de réduction pour les offres
            $table->boolean('est_en_avant')->default(false)->after('reduction'); // Pour les produits mis en avant
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->dropColumn(['est_nouveaute', 'est_offre', 'reduction', 'est_en_avant']);
        });
    }
};
