<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['nom_categorie', 'description'];
    
    public function getNomAttribute()
    {
        return $this->attributes['nom_categorie'];
    }
    
    public function setNomAttribute($value)
    {
        $this->attributes['nom_categorie'] = $value;
    }
}
