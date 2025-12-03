<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Salle;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Affiche la liste de tous les patients (Panel général).
     */
    public function index()
    {
        // Récupère les patients avec leurs salles et leurs derniers dossiers actifs.
        $patients = Patient::with(['salle', 'dernierDossier'])
                           ->orderBy('nom')
                           ->get();
        
        return view('patients.index', compact('patients'));
    }

    /**
     * Affiche le profil complet d'un patient et son historique médical. (EXISTANTE)
     */
    public function show(Patient $patient)
    {
        $patient->load('salle');
        $historique_dossiers = $patient->dossiers()->with(['medecin', 'consultation'])->latest()->get();

        return view('patients.show', compact('patient', 'historique_dossiers'));
    }

    /**
     * Affiche le formulaire de modification d'un patient.
     */
    public function edit(Patient $patient)
    {
        // Nécessaire pour le choix de la salle
        $salles = Salle::all(); 
        
        return view('patients.edit', compact('patient', 'salles'));
    }

    /**
     * Met à jour les informations du patient spécifié.
     */
    public function update(Request $request, Patient $patient)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0',
            'tel' => 'nullable|string|max:20',
            // L'email doit être unique sauf pour le patient actuel
            'email' => 'nullable|email|unique:patients,email,' . $patient->id_patient . ',id_patient',
            'id_salle' => 'nullable|exists:salles,id_salle',
            'statut' => 'required|string|in:Admis,En_Consultation,En_Traitement,Sorti', // Assurer la validité du statut
        ]);

        // Gérer le cas où la salle est décochée (id_salle = null)
        $validatedData['id_salle'] = $request->id_salle == 0 ? null : $request->id_salle;

        $patient->update($validatedData);

        return redirect()->route('patients.show', $patient->id_patient)
                         ->with('success', 'Profil de ' . $patient->nom . ' mis à jour.');
    }

    /**
     * Supprime le patient spécifié.
     */
    public function destroy(Patient $patient)
    {
        // Vérification : Un patient ne doit pas avoir de dossiers actifs avant la suppression
        if ($patient->dossiers()->count() > 0) {
            // NOTE : En production, on supprimerait les dossiers, mais pour la sécurité/l'historique, on bloque souvent.
            return back()->withErrors('Impossible de supprimer le patient : il possède un historique médical (dossiers). Archivez ou désactivez-le à la place.');
        }
        
        $patient->delete();

        return redirect()->route('patients.index')
                         ->with('success', 'Patient ' . $patient->nom . ' supprimé avec succès.');
    }
}
