@extends('layouts.app')

@section('title', 'Modifier Salle')

@section('content')
    <a href="{{ route('salles.index') }}">← Retour à la Gestion des Salles</a>

    <h2>Modifier la Salle N°{{ $salle->id_salle }}</h2>
    
    <form method="POST" action="{{ route('salles.update', $salle->id_salle) }}">
        @csrf
        @method('PUT')
        
        <label for="type">Nom ou Type de Salle :</label>
        <input type="text" name="type" value="{{ old('type', $salle->type) }}" required>
        
        <button type="submit" style="background-color: #ffc107; color: #333;">Sauvegarder les Modifications</button>
    </form>
@endsection
