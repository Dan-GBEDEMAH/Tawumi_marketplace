<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_commercant_fk',
        'date_commande',
        'statut_en_attente_valide_annule_etc',
        'date_expedition',
        'nom_client',
        'email_client',
        'telephone_client',
        'adresse_livraison',
        'ville_livraison',
        'code_postal_livraison',
        'instructions_livraison',
        'mode_livraison',
    ];

    protected $casts = [
        'date_commande' => 'datetime',
        'date_expedition' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_commercant_fk');
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit', 'id_commande_fk', 'id_produit_fk')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'id_commande_fk');
    }
}