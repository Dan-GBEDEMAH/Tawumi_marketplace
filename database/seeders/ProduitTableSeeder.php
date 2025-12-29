<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ProduitTableSeeder extends Seeder
{
    public function run(): void
    {
        // Récupération des catégories
        $legumes     = DB::table('categories')->where('nom_categorie', 'Légumes')->first();
        $fruits      = DB::table('categories')->where('nom_categorie', 'Fruits')->first();
        $cereales    = DB::table('categories')->where('nom_categorie', 'Céréales')->first();
        $plante      = DB::table('categories')->where('nom_categorie', 'Plantes médicinales')->first();
        $tubercules  = DB::table('categories')->where('nom_categorie', 'Tubercules')->first();

        DB::table('produits')->insert([
           
            [
                'nom' => 'Épinards',
                'description' => 'Épinards verts frais',
                'prix_unitaire' => 220,
                'unite_mesure_douzaine' => 'botte',
                'stock_disponible' => 70,
                'image_produit' => 'epinards.jpg',
                'id_producteur_fk' => 3,
                'id_categorie_fk' => $legumes->id,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
           
            [
                'nom' => 'Poivron',
                'description' => 'Poivrons frais',
                'prix_unitaire' => 240,
                'unite_mesure_douzaine' => 'kg',
                'stock_disponible' => 45,
                'image_produit' => 'poivron.jpg',
                'id_producteur_fk' => 2,
                'id_categorie_fk' => $legumes->id,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'nom' => 'Ananas',
                'description' => 'Ananas sucré',
                'prix_unitaire' => 350,
                'unite_mesure_douzaine' => 'unité',
                'stock_disponible' => 30,
                'image_produit' => 'ananas.jpg',
                'id_producteur_fk' => 2,
                'id_categorie_fk' => $fruits->id,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'nom' => 'Adémè',
                'description' => 'Feuilles d Adémè',
                'prix_unitaire' => 400,
                'unite_mesure_douzaine' => 'botte',
                'stock_disponible' => 60,
                'image_produit' => 'ademe.jpg',
                'id_producteur_fk' => 3,
                'id_categorie_fk' => $plante->id,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
       
           
        ]);
    }
}
