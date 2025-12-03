<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Consultation extends Model
{
    protected $primaryKey = 'id_consultation';

    protected $fillable = [
        'id_patient',
        'id_medecin',
        'id_dossier',
        'date',
    ];
    
    protected $casts = [
        'date' => 'datetime', 
    ];
    
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'id_patient', 'id_patient');
    }

    // Relation N:1 (La consultation a été faite par un médecin)
    public function medecin(): BelongsTo
    {
        return $this->belongsTo(Medecin::class, 'id_medecin', 'id_medecin');
    }

    // Relation 1:1 (Une consultation génère un seul dossier)
    public function dossier(): BelongsTo
    {
        // La consultation contient la clé étrangère id_dossier
        return $this->belongsTo(Dossier::class, 'id_dossier', 'id_dossier');
    }
}
