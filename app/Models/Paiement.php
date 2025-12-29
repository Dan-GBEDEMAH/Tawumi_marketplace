<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_commande_fk',
        'montant',
        'date_paiement',
        'statut_paiement',
        'methode_TMoney_Flooz',
    ];

    protected $casts = [
        'date_paiement' => 'datetime',
        'montant' => 'decimal:2',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande_fk');
    }
}