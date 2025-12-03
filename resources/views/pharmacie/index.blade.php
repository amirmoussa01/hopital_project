@extends('layouts.app')

@section('title', 'Pharmacie - Recherche Patient')

@section('content')
    <h2>Interface Pharmacie</h2>
    
    <div style="width: 50%; margin: 0 auto; padding: 20px; background: #f0f8ff; border-radius: 8px;">
        <h3>Rechercher un Patient par ID</h3>
        <p>Entrez l'identifiant du patient pour consulter sa prescription la plus récente.</p>
        
        <form method="POST" action="{{ route('pharmacie.show') }}">
            @csrf
            <label for="id_patient">ID du Patient :</label>
            <input type="number" name="id_patient" required placeholder="Ex: 1, 2, 3">
            
            <button type="submit" style="background-color: #007bff;">Afficher la Prescription</button>
        </form>
    </div>
@endsection
