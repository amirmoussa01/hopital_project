<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Salle;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function create()
    {
        // On récupère toutes les salles pour le choix dans le formulaire
        $salles = Salle::all();
        
        return view('admission.create', compact('salles'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0',
            'tel' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:patients,email',
            'id_salle' => 'nullable|exists:salles,id_salle',
        ]);

        // Ajout des valeurs par défaut
        $validatedData['statut'] = 'Admis'; 

        // Création du Patient
        $patient = Patient::create($validatedData);

        // Redirection vers la fiche du patient nouvellement créé
        return redirect()->route('patients.show', $patient->id_patient)
                         ->with('success', '✅ Le patient ' . $patient->nom . ' ' . $patient->prenom . ' a été admis et enregistré.');
    }
}
