<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Affiche la liste de toutes les consultations, avec options de filtre.
     */
    public function index(Request $request)
    {
        // 1. Début de la requête : charger les consultations et les relations nécessaires
        $query = Consultation::with(['patient', 'medecin', 'dossier'])->latest();

        // 2. Gestion des filtres
        
        // Filtrer par patient (si un ID est fourni dans l'URL)
        if ($request->filled('id_patient')) {
            $query->where('id_patient', $request->id_patient);
        }

        // Filtrer par médecin (si un ID est fourni dans l'URL)
        if ($request->filled('id_medecin')) {
            $query->where('id_medecin', $request->id_medecin);
        }

        // Exécuter la requête
        $consultations = $query->get();

        // 3. Charger les listes pour les filtres dans la vue
        $patients = Patient::select('id_patient', 'nom', 'prenom')->orderBy('nom')->get();
        $medecins = Medecin::select('id_medecin', 'nom', 'prenom')->orderBy('nom')->get();

        return view('consultations.index', [
            'consultations' => $consultations,
            'patients' => $patients,
            'medecins' => $medecins,
            // Garder les filtres actifs pour la vue
            'active_patient_id' => $request->id_patient,
            'active_medecin_id' => $request->id_medecin,
        ]);
    }

    // Nous n'avons pas besoin de show, create, store, update, destroy ici 
    // car la création est gérée par le MedecinController.
}
