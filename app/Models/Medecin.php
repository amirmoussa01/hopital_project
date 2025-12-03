<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medecin extends Model
{
    protected $primaryKey = 'id_medecin';
    
    /**
     * Les attributs qui peuvent être assignés en masse.
     */
    protected $fillable = [
        'nom',
        'prenom',
        'specialite',
        'email',
    ];

    // ... (relations existantes)
    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class, 'id_medecin', 'id_medecin');
    }

    public function dossiers(): HasMany
    {
        return $this->hasMany(Dossier::class, 'id_medecin', 'id_medecin');
    }
}

