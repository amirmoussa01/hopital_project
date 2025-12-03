<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PharmacieController extends Controller
{
    /**
     * Affiche l'interface de recherche de la pharmacie.
     */
    public function index()
    {
        return view('pharmacie.index');
    }

    /**
     * Affiche la prescription du dernier dossier actif d'un patient.
     */
    public function showPrescription(Request $request)
    {
        $request->validate([
            'id_patient' => 'required|exists:patients,id_patient',
        ]);

        $patient = Patient::with('dernierDossier.medecin')
                          ->find($request->id_patient);

        // Vérifie si le patient a un dossier actif
        if (!$patient || !$patient->dernierDossier) {
            return back()->withErrors('Patient trouvé, mais aucun dossier médical actif pour délivrer une prescription.');
        }

        // On passe le patient et son dernier dossier à la vue
        return view('pharmacie.prescription', [
            'patient' => $patient,
            'dossier' => $patient->dernierDossier
        ]);
    }
}
