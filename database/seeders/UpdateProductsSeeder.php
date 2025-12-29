<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class UpdateProductsSeeder extends Seeder
{
    public function run(): void
    {
        // Mise à jour aléatoire de certains produits pour les marquer comme nouveautés ou offres
        $produits = DB::table('produits')->get();
        
        foreach ($produits as $produit) {
            $updateData = [
                'est_nouveaute' => rand(1, 3) === 1 ? true : false, // 1/3 des produits sont des nouveautés
                'est_offre' => rand(1, 4) === 1 ? true : false, // 1/4 des produits sont des offres
                'est_en_avant' => rand(1, 5) === 1 ? true : false, // 1/5 des produits sont mis en avant
                'updated_at' => new DateTime(),
            ];
            
            // Si c'est une offre, ajouter une réduction aléatoire entre 5% et 50%
            if ($updateData['est_offre']) {
                $updateData['reduction'] = rand(5, 50);
            }
            
            DB::table('produits')
                ->where('id', $produit->id)
                ->update($updateData);
        }
    }
}