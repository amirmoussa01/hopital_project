<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    // Indiquer la clé primaire non conventionnelle
    protected $primaryKey = 'id_patient';  
    
    // Définition des champs qui peuvent être remplis via Patient::create()
    protected $fillable = [
        'nom',
        'prenom',
        'tel',
        'age',
        'email',
        'id_salle',
        'id_dossier', // Bien que nullable par défaut
        'statut',
    ];

    // Relation 1:N (Le patient a plusieurs consultations)
    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class, 'id_patient', 'id_patient');
    }

    // Relation 1:N (Le patient a plusieurs dossiers - son historique)
    public function dossiers(): HasMany
    {
        return $this->hasMany(Dossier::class, 'id_patient', 'id_patient');
    }

    // Relation 1:N (Le patient appartient à une salle)
    public function salle(): BelongsTo
    {
        return $this->belongsTo(Salle::class, 'id_salle', 'id_salle');
    }

    // Relation 1:1 (Le dernier dossier actif)
    public function dernierDossier(): BelongsTo
    {
        return $this->belongsTo(Dossier::class, 'id_dossier', 'id_dossier');
    }
}

