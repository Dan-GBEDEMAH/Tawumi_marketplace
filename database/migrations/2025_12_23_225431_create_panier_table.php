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
        Schema::create('panier', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produit_fk');
            $table->unsignedBigInteger('id_user_fk');
            $table->integer('statut_actif_convert')->default(1);
            $table->unsignedBigInteger('id_commercant_fk');
            $table->timestamps();
            
            $table->foreign('id_produit_fk')->references('id')->on('produits')->onDelete('cascade');
            $table->foreign('id_user_fk')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_commercant_fk')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panier');
    }
};