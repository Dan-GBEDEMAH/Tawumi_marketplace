<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;
    
    protected $table = 'panier';

    protected $fillable = [
        'id_produit_fk',
        'id_user_fk',
        'statut_actif_convert',
        'id_commercant_fk',
        'quantite',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit_fk');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_fk');
    }
}