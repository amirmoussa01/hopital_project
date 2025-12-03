@extends('layouts.app')

@section('title', 'Caisse - Facturation Patient')

@section('content')
    <h2>Interface Caisse</h2>
    
    <div style="width: 50%; margin: 0 auto; padding: 20px; background: #fff0f0; border-radius: 8px;">
        <h3>Rechercher un Patient par ID</h3>
        <p>Entrez l'identifiant du patient pour établir la facture.</p>
        
        <form method="POST" action="{{ route('caisse.show') }}">
            @csrf
            <label for="id_patient">ID du Patient :</label>
            <input type="number" name="id_patient" required placeholder="Ex: 1, 2, 3">
            
            <button type="submit" style="background-color: #dc3545;">Afficher la Facture</button>
        </form>
    </div>
@endsection
