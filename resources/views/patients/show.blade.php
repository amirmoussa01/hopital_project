@extends('layouts.app')

@section('title', 'Fiche Patient: ' . $patient->nom . ' ' . $patient->prenom)

@section('content')
    <h2>Fiche Patient: {{ $patient->prenom }} {{ $patient->nom }}</h2>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 30px;">
        <div style="background: #f9f9f9; padding: 20px; border-radius: 6px;">
            <h3>Détails Personnels</h3>
            <p><strong>Âge:</strong> {{ $patient->age ?? 'N/A' }}</p>
            <p><strong>Contact:</strong> {{ $patient->tel }} / {{ $patient->email }}</p>
            <p><strong>Statut Actuel:</strong> <span style="font-weight: bold; color: {{ $patient->statut == 'Admis' ? '#007bff' : '#28a745' }};">{{ $patient->statut }}</span></p>
        </div>
        
        <div style="background: #f9f9f9; padding: 20px; border-radius: 6px;">
            <h3>Placement & Actif</h3>
            <p><strong>Salle Actuelle:</strong> {{ $patient->salle->type ?? 'Non attribuée' }} (ID: {{ $patient->id_salle ?? 'N/A' }})</p>
            <p><strong>Dossier Actif:</strong> <span style="font-weight: bold;">{{ $patient->id_dossier ?? 'Aucun' }}</span></p>
            
            <a href="{{ route('consultation.create', $patient->id_patient) }}" 
               style="display: inline-block; background-color: #ffc107; color: #333; padding: 10px 15px; text-decoration: none; border-radius: 4px; margin-top: 15px;">
                Démarrer une Nouvelle Consultation
            </a>
        </div>
    </div>
    
    <hr>
    
    <h3>Historique Médical Complet ({{ $historique_dossiers->count() }} Dossiers)</h3>
    
    @forelse ($historique_dossiers as $dossier)
        <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 4px;">
            <h4>Dossier n°{{ $dossier->id_dossier }} - 
                <small>{{ $dossier->consultation->date->format('d/m/Y H:i') ?? 'Date N/A' }}</small>
            </h4>
            <p>Médecin Traitant : <strong>{{ $dossier->medecin->prenom }} {{ $dossier->medecin->nom }}</strong></p>
            
            <p><strong>RÉSUMÉ/DIAGNOSTIC :</strong> {{ $dossier->consultation_resume }}</p>
            
            <p><strong>PRESCRIPTION (Pharmacie) :</strong> <br/>
                <i style="color: #007bff;">{{ $dossier->prescription ?? 'Aucune prescription médicale.' }}</i>
            </p>
            
            <p><strong>EXAMENS DEMANDÉS (Caisse) :</strong> <br/>
                <i style="color: #dc3545;">{{ $dossier->examen ?? 'Aucun examen demandé.' }}</i>
            </p>
        </div>
    @empty
        <p>Aucun dossier médical trouvé pour ce patient. C'est le tout premier enregistrement.</p>
    @endforelse
@endsection
