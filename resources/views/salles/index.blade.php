@extends('layouts.app')

@section('title', 'Gestion des Salles et Chambres')

@section('content')
    <h2>Gestion des Salles et Chambres</h2>
    
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 40px;">
        
        <div>
            <h3> Ajouter une Nouvelle Salle</h3>
            <form method="POST" action="{{ route('salles.store') }}">
                @csrf
                <label for="type">Nom ou Type de Salle (Ex: Urgence, Pédiatrie, Salle 301) :</label>
                <input type="text" name="type" value="{{ old('type') }}" required>
                
                <button type="submit">Créer la Salle</button>
            </form>
        </div>

        <div>
            <h3>Liste des Salles ({{ $salles->count() }})</h3>
            <ul style="list-style-type: none; padding: 0;">
                @forelse ($salles as $salle)
                    <li style="background: #f0f0f0; margin-bottom: 8px; padding: 10px; border-radius: 4px;">
                        <strong>ID {{ $salle->id_salle }}:</strong> {{ $salle->type }} 
                        </li>
                @empty
                    <p style="color: #dc3545;">Aucune salle enregistrée. Veuillez en ajouter une ci-dessus.</p>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
