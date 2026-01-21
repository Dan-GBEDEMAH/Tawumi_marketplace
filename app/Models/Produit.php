<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $casts = [
        'prix_unitaire' => 'decimal:2',
        'reduction' => 'decimal:2',
        'est_nouveaute' => 'boolean',
        'est_offre' => 'boolean',
        'est_en_avant' => 'boolean',
        'est_gratuit' => 'boolean',
        'est_offre_weekend' => 'boolean',
        'date_debut_offre' => 'datetime',
        'date_fin_offre' => 'datetime',
        'stock_disponible' => 'integer',
    ];

    protected $fillable = [
        'nom',
        'description',
        'prix_unitaire',
        'unite_mesure_douzaine',
        'stock_disponible',
        'image_produit',
        'id_producteur_fk',
        'id_commercant_fk',
        'id_categorie_fk',
        'est_nouveaute',
        'est_offre',
        'reduction',
        'est_en_avant',
        'est_gratuit',
        'quantite_limitee',
        'est_offre_weekend',
        'date_debut_offre',
        'date_fin_offre',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie_fk');
    }

    public function producteur()
    {
        return $this->belongsTo(User::class, 'id_producteur_fk');
    }

    public function commercant()
    {
        return $this->belongsTo(User::class, 'id_commercant_fk');
    }

    public function paniers()
    {
        return $this->hasMany(Panier::class, 'id_produit_fk');
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit', 'id_produit_fk', 'id_commande_fk')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }

    // Accessors
    public function getNomAttribute($value)
    {
        return ucfirst($value);
    }

    public function getPrixAttribute()
    {
        // Calculer le prix avec réduction si applicable
        if ($this->est_offre && $this->reduction > 0) {
            $prixReduit = $this->prix_unitaire * (1 - $this->reduction / 100);
            return $prixReduit;
        }
        
        // Si c'est un produit gratuit, le prix est 0
        if ($this->est_gratuit) {
            return 0;
        }
        
        return $this->prix_unitaire;
    }
    
    public function getPrixOriginalAttribute()
    {
        return $this->prix_unitaire;
    }
    
    public function getEstEnPromoAttribute()
    {
        $now = now();
        
        // Vérifier si les dates d'offre sont définies et valides
        $dateDebutValide = !$this->date_debut_offre || $this->date_debut_offre->lte($now);
        $dateFinValide = !$this->date_fin_offre || $this->date_fin_offre->gte($now);
        
        return ($this->est_offre || $this->est_gratuit || $this->est_offre_weekend) && 
               $dateDebutValide && 
               $dateFinValide;
    }

    public function getImageAttribute()
    {
        if ($this->image_produit) {
            // Vérifier si le fichier existe physiquement dans le stockage
            if (file_exists(storage_path('app/public/' . $this->image_produit))) {
                return '/storage/' . $this->image_produit;
            } else {
                // Si le fichier n'existe pas, retourner une image de substitution
                return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5vIEltYWdlPC90ZXh0Pjwvc3ZnPg==';
            }
        }
        return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5vIEltYWdlPC90ZXh0Pjwvc3ZnPg=='; // Default SVG placeholder image
    }
}