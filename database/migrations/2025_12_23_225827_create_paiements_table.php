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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_commande_fk');
            $table->decimal('montant', 10, 2);
            $table->dateTime('date_paiement');
            $table->string('statut_paiement');
            $table->string('methode_TMoney_Flooz');
            $table->timestamps();
            
            $table->foreign('id_commande_fk')->references('id')->on('commandes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};