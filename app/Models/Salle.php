<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salle extends Model
{
    protected $primaryKey = 'id_salle';
    
    protected $fillable = [
        'type', 
    ];

    // Relation 1:N (Une salle accueille plusieurs patients)
    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class, 'id_salle', 'id_salle');
    }
}

