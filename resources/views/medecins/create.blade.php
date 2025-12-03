@extends('layouts.app')

@section('title', 'Ajout de Médecin')

@section('content')
    <h2>➕ Ajouter un Nouveau Médecin</h2>
    
    <form method="POST" action="{{ route('medecins.store') }}">
        @csrf
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required>

        <label for="email">Email :</label>
        <input type="email" name="email" required>

        <label for="specialite">Spécialité :</label>
        <input type="text" name="specialite">
        
        <button type="submit">Enregistrer le Médecin</button>
    </form>
@endsection
