@extends('layouts.app')

@section('title', 'Modifier Médecin')

@section('content')
    <a href="{{ route('medecins.index') }}">← Retour à la Gestion des Médecins</a>

    <h2>Modifier le Profil de Dr. {{ $medecin->nom }}</h2>
    
    <form method="POST" action="{{ route('medecins.update', $medecin->id_medecin) }}">
        @csrf
        @method('PUT')
        
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="{{ old('nom', $medecin->nom) }}" required>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" value="{{ old('prenom', $medecin->prenom) }}" required>

        <label for="email">Email :</label>
        <input type="email" name="email" value="{{ old('email', $medecin->email) }}" required>

        <label for="specialite">Spécialité :</label>
        <input type="text" name="specialite" value="{{ old('specialite', $medecin->specialite) }}">
        
        <button type="submit" style="background-color: #ffc107; color: #333;">Sauvegarder les Modifications</button>
    </form>
@endsection
