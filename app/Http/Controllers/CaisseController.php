<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class CaisseController extends Controller
{
    /**
     * Affiche l'interface de recherche de la caisse.
     */
    public function index()
    {
        return view('caisse.index');
    }

    /**
     * Affiche les frais (examens et médicaments) du dernier dossier actif.
     */
    public function showFrais(Request $request)
    {
        $request->validate([
            'id_patient' => 'required|exists:patients,id_patient',
        ]);

        $patient = Patient::with('dernierDossier.medecin')
                          ->find($request->id_patient);
                          
        if (!$patient || !$patient->dernierDossier) {
            return back()->withErrors('Patient trouvé, mais aucun dossier médical actif pour le facturer.');
        }

        return view('caisse.facture', [
            'patient' => $patient,
            'dossier' => $patient->dernierDossier
        ]);
    }
}
