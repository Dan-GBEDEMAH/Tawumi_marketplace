<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_producteur_fk')->nullable();
            $table->unsignedBigInteger('id_commercant_fk')->nullable();
            $table->unsignedBigInteger('id_user_fk');
            $table->integer('note');
            $table->dateTime('date_avis');
            $table->timestamps();
            
            $table->foreign('id_producteur_fk')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_commercant_fk')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_user_fk')->references('id')->on('users')->onDelete('cascade');
        });
        
        // Ajouter la contrainte de validation pour la note
        DB::statement('ALTER TABLE avis ADD CONSTRAINT check_note_range CHECK (note BETWEEN 0 AND 5)');
        
        // Ajouter la contrainte pour s'assurer qu'un avis est soit pour un producteur, soit pour un commerçant
        DB::statement('ALTER TABLE avis ADD CONSTRAINT chk_producer_or_merchant CHECK (id_producteur_fk IS NOT NULL OR id_commercant_fk IS NOT NULL)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};