<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'mot_passe',
        'addresse',
        'nom_domaine',
        'description_domaine',
        'telephone',
        'role',
        'sexe',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'mot_passe',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mot_passe' => 'hashed',
        ];
    }
    
    /**
     * Mutator pour le mot de passe
     */
    public function setMotPasseAttribute($value)
    {
        $this->attributes['password'] = $value;
    }
    
    /**
     * Accessor pour le mot de passe
     */
    public function getMotPasseAttribute()
    {
        return $this->attributes['password'];
    }
}
