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
        Schema::create('commande_produit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_commande_fk');
            $table->unsignedBigInteger('id_produit_fk');
            $table->integer('quantite')->default(1);
            $table->decimal('prix_unitaire', 10, 2);
            $table->timestamps();
            
            $table->foreign('id_commande_fk')->references('id')->on('commandes')->onDelete('cascade');
            $table->foreign('id_produit_fk')->references('id')->on('produits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_produit');
    }
};
