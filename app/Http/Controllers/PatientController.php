<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function show(Patient $patient)
    {
        // Charge les relations nécessaires pour l'affichage (salle et historique)
        $patient->load('salle');
        $historique_dossiers = $patient->dossiers()->with(['medecin', 'consultation'])->latest()->get();

        return view('patients.show', compact('patient', 'historique_dossiers'));
    }
}
