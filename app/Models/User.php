<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

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
        'password',
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
        ];
    }
    
    /**
     * Mutator pour le mot de passe (mapping vers le champ password)
     */
    public function setMotPasseAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    
    /**
     * Accessor pour le mot de passe (mapping depuis le champ password)
     */
    public function getMotPasseAttribute()
    {
        return $this->attributes['password'];
    }
    
    /**
     * Override the getAttribute method to handle mot_passe
     */
    public function getAttribute($key)
    {
        if ($key === 'mot_passe') {
            return $this->getMotPasseAttribute();
        }
        
        return parent::getAttribute($key);
    }
    
    /**
     * Check if password is hashed
     */
    public function isPasswordHashed($password)
    {
        return strlen($password) >= 60 && substr($password, 0, 4) === '$2y$';
    }
    
    /**
     * Override the password attribute to ensure it's always hashed
     */
    public function getPasswordAttribute($value)
    {
        // If the password is not hashed, we should handle this gracefully
        if ($value && !$this->isPasswordHashed($value)) {
            // Return a fake hash to prevent timing attacks, but make comparison fail
            return '$2y$10$'.str_repeat('a', 50); // Invalid hash that will always fail
        }
        return $value;
    }
    
    /**
     * Override the setAttribute method to handle mot_passe
     */
    public function setAttribute($key, $value)
    {
        if ($key === 'mot_passe') {
            $this->setMotPasseAttribute($value);
            return $this;
        }
        
        // Ensure password field always has a value to satisfy NOT NULL constraint
        if ($key === 'password' && empty($value)) {
            $value = Hash::make('default_password_' . time() . rand(1000, 9999));
        }
        
        return parent::setAttribute($key, $value);
    }
}