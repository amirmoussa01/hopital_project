<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dossier extends Model
{
    protected $primaryKey = 'id_dossier';

    protected $fillable = [
        // Clés étrangères
        'id_patient',     // <-- CORRECTION : Ajout de la clé patient
        'id_medecin',     // <-- CORRECTION : Ajout de la clé médecin
        
        // Contenu du dossier
        'consultation_resume',
        'prescription',
        'examen',
    ];

    // Relation 1:1 (Un dossier provient d'une seule consultation)
    public function consultation(): HasOne
    {
        // Un dossier n'a qu'une consultation, et la consultation contient la FK id_dossier
        return $this->hasOne(Consultation::class, 'id_dossier', 'id_dossier');
    }

    // Relation N:1 (Le dossier appartient à un patient)
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'id_patient', 'id_patient');
    }

    // Relation N:1 (Le dossier a été créé par un médecin)
    public function medecin(): BelongsTo
    {
        return $this->belongsTo(Medecin::class, 'id_medecin', 'id_medecin');
    }
}


