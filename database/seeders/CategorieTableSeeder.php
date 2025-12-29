<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CategorieTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->truncate(); // Clear existing categories
        DB::table('categories')->insert([
            [
                'nom_categorie' => 'Céréales',
                'description' => 'Catégorie de céréales',
                'created_at' => new DateTime(),
                'updated_at' => null,
            ],
            [
                'nom_categorie' => 'Fruits',
                'description' => 'Catégorie de fruits',
                'created_at' => new DateTime(),
                'updated_at' => null,
            ],
            [
                'nom_categorie' => 'Légumes',
                'description' => 'Catégorie de légumes',
                'created_at' => new DateTime(),
                'updated_at' => null,
            ],
            [
                'nom_categorie' => 'Plantes médicinales',
                'description' => 'Catégorie de plantes médicinales',
                'created_at' => new DateTime(),
                'updated_at' => null,
            ],
            [
                'nom_categorie' => 'Tubercules',
                'description' => 'Catégorie de tubercules',
                'created_at' => new DateTime(),
                'updated_at' => null,
            ],
        ]);
    }
}
