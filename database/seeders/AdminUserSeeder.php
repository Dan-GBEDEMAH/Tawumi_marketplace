<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         if (!User::where('email', 'tawumi@gmail.com')->exists()) {
            User::create([
                'prenom' => 'Admin',
                'nom' => 'Tawumi',
                'email' => 'tawumi@gmail.com',
                'mot_passe' => Hash::make('secret'), 
                'addresse' => 'Adresse par défaut',
                'telephone' => '',
                'role' => 'admin',
            ]);
        }
    }
    
}
    