@extends('layouts.app')

@section('title', 'Gestion des Salles et Chambres')

@section('content')
    <h2>Gestion des Salles et Chambres</h2>
    
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 40px;">
        
        <div class="card">
            <h3>Ajouter une Nouvelle Salle</h3>
            
            <form method="POST" action="{{ route('salles.store') }}">
                @csrf
                
                <label for="type">Nom ou Type de Salle (Ex: Pédiatrie, Réanimation 1) :</label>
                <input type="text" name="type" value="{{ old('type') }}" required>
                
                <button type="submit" class="btn">Créer la Salle</button>
            </form>
        </div>
        <div class="card">
            <h3>Liste des Salles ({{ $salles->count() }})</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: var(--primary-color); color: white;">
                        <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
                        <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Type</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Patients Actifs</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salles as $salle)
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $salle->id_salle }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $salle->type }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $salle->patients_count }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                <a href="{{ route('salles.edit', $salle->id_salle) }}" class="btn-warning" style="text-decoration: none; padding: 5px 10px; margin-right: 5px;">Modifier</a>

                                <form action="{{ route('salles.destroy', $salle->id_salle) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{ $salle->type }} ?')" 
                                            class="btn-danger" style="padding: 5px 10px;">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Aucune salle enregistrée.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
