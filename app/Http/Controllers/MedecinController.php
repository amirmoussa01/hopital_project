<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedecinController extends Controller
{
    /**
     * Affiche la liste de tous les médecins (Panel général).
     */
    public function index()
    {
        // Récupérer les médecins avec le compte de leurs dossiers (pour la suppression)
        $medecins = Medecin::withCount('dossiers')->get();
        return view('medecins.index', compact('medecins'));
    }

    /**
     * Affiche le formulaire pour ajouter un nouveau médecin.
     */
    public function create()
    {
        return view('medecins.create');
    }

    /**
     * Enregistre un nouveau médecin dans la base.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite' => 'nullable|string|max:255',
            'email' => 'required|email|unique:medecins,email'
        ]);
        
        Medecin::create($validated);
        
        return redirect()->route('medecins.index')->with('success', 'Le médecin ' . $validated['nom'] . ' a été ajouté avec succès.');
    }
    
    /**
     * Affiche le formulaire de modification d'un médecin.
     */
    public function edit(Medecin $medecin)
    {
        return view('medecins.edit', compact('medecin'));
    }

    /**
     * Met à jour le médecin spécifié.
     */
    public function update(Request $request, Medecin $medecin)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            // L'email doit être unique sauf pour le médecin actuel
            'email' => 'required|email|unique:medecins,email,' . $medecin->id_medecin . ',id_medecin', 
            'specialite' => 'nullable|string|max:255',
        ]);

        $medecin->update($validated);

        return redirect()->route('medecins.index')
                         ->with('success', 'Dr. ' . $medecin->nom . ' mis à jour avec succès.');
    }

    /**
     * Supprime le médecin spécifié.
     */
    public function destroy(Medecin $medecin)
    {
        // Vérification pour s'assurer qu'aucun dossier n'est lié à ce médecin
        if ($medecin->dossiers()->count() > 0) {
             return back()->withErrors('Impossible de supprimer Dr. ' . $medecin->nom . ' : il a déjà des dossiers et consultations enregistrés. (Règle ON DELETE RESTRICT)');
        }
        
        $medecin->delete();

        return redirect()->route('medecins.index')
                         ->with('success', 'Dr. ' . $medecin->nom . ' a été supprimé.');
    }

    public function createConsultation(Patient $patient)
    {
        // RÉCUPÉRATION DE TOUS LES MÉDECINS POUR LE CHOIX
        $medecins = Medecin::all(); 
        
        if ($medecins->isEmpty()) {
            // Redirige si aucun médecin n'existe, car c'est obligatoire pour une consultation.
            return back()->withErrors('Erreur: Aucun médecin n\'est enregistré. Veuillez en ajouter un d\'abord.')
                         ->with('link', route('medecins.create')); // Suggestion de lien pour l'utilisateur
        }

        // On passe la collection de tous les médecins à la vue
        return view('consultation.create', compact('patient', 'medecins'));
    }
    /**
     * Crée une Consultation et le Dossier Médical associé.
     */
    public function storeConsultation(Request $request, Patient $patient)
    {
        $request->validate([
            'id_medecin' => 'required|exists:medecins,id_medecin',
            'consultation_resume' => 'required|string',
            'prescription' => 'nullable|string',
            'examen' => 'nullable|string',
        ]);

        // --- DÉBUT DE LA TRANSACTION ---
        try {
            DB::beginTransaction();

            // 1. Création du Dossier Médical
            $dossier = Dossier::create([
                'id_patient' => $patient->id_patient,
                'id_medecin' => $request->id_medecin,
                'consultation_resume' => $request->consultation_resume,
                'prescription' => $request->prescription,
                'examen' => $request->examen,
            ]);

            // 2. Création de l'entrée Consultation (1:1 avec Dossier)
            Consultation::create([
                'id_patient' => $patient->id_patient,
                'id_medecin' => $request->id_medecin,
                'id_dossier' => $dossier->id_dossier, // Lien clé 1:1
                'date' => now(),
            ]);

            // 3. Mise à jour du Patient (Dernier Dossier Actif)
            $patient->id_dossier = $dossier->id_dossier;
            $patient->statut = 'En_Traitement'; // Mise à jour du statut
            $patient->save();

            DB::commit();
            // --- FIN DE LA TRANSACTION ---

            return redirect()->route('patients.show', $patient->id_patient)
                             ->with('success', 'Consultation et Dossier médical créés avec succès. Patient mis à jour.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors('Erreur lors de la création du dossier/consultation : ' . $e->getMessage());
        }
    }
}
