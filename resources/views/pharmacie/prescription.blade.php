@extends('layouts.app')

@section('title', 'Prescription Patient')

@section('content')
    <a href="{{ route('pharmacie.index') }}" style="display: block; margin-bottom: 20px;">
        ← Retour à la Recherche Pharmacie
    </a>

    <h2>Prescription pour {{ $patient->prenom }} {{ $patient->nom }} (ID: {{ $patient->id_patient }})</h2>
    
    <div style="border: 2px solid #28a745; padding: 20px; border-radius: 8px; background: #e6ffed;">
        <h3>Dossier N°{{ $dossier->id_dossier }} - Prescription Médicale</h3>
        <p>Date de la Consultation : <strong>{{ $dossier->consultation->date->format('d/m/Y H:i') ?? 'N/A' }}</strong></p>
        <p>Médecin Prescripteur : <strong>Dr. {{ $dossier->medecin->prenom }} {{ $dossier->medecin->nom }}</strong></p>
        <hr>
        
        @if ($dossier->prescription)
            <pre style="white-space: pre-wrap; background: #fff; padding: 15px; border-radius: 4px; border-left: 5px solid #28a745; font-size: 1.1em;">{{ $dossier->prescription }}</pre>
            <button style="background-color: #28a745;">Médicaments Délivrés (Action non enregistrée en DB)</button>
        @else
            <p style="color: red; font-weight: bold;">Aucune prescription enregistrée dans ce dossier.</p>
        @endif
    </div>
@endsection
