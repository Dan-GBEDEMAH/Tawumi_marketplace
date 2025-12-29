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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description')->nullable();
            $table->decimal('prix_unitaire', 10, 2);
            $table->string('unite_mesure_douzaine')->nullable();
            $table->integer('stock_disponible')->default(0);
            $table->string('image_produit')->nullable();
            $table->unsignedBigInteger('id_producteur_fk');
            $table->unsignedBigInteger('id_commercant_fk')->nullable();
            $table->unsignedBigInteger('id_categorie_fk');
            $table->timestamps();
            
            $table->foreign('id_producteur_fk')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_commercant_fk')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_categorie_fk')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
