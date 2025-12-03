@extends('layouts.app')

@section('title', 'Gestion des Médecins')

@section('content')
    <h2>Panel de Gestion des Médecins</h2>
    
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 40px;">
        
        <div>
            <h3>Ajouter un Nouveau Médecin</h3>
            <form method="POST" action="{{ route('medecins.store') }}">
                @csrf
                <label for="nom">Nom :</label>
                <input type="text" name="nom" value="{{ old('nom') }}" required>

                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" value="{{ old('prenom') }}" required>

                <label for="email">Email :</label>
                <input type="email" name="email" value="{{ old('email') }}" required>

                <label for="specialite">Spécialité :</label>
                <input type="text" name="specialite" value="{{ old('specialite') }}">
                
                <button type="submit" style="background-color: #007bff;">Enregistrer le Médecin</button>
            </form>
        </div>

        <div>
            <h3>Liste des Médecins ({{ $medecins->count() }})</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #007bff; color: white;">
                        <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
                        <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Nom & Prénom</th>
                        <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Spécialité</th>
                        <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Dossiers Créés</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($medecins as $medecin)
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $medecin->id_medecin }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Dr. {{ $medecin->prenom }} {{ $medecin->nom }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $medecin->specialite ?? 'N/A' }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $medecin->dossiers_count }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                <a href="{{ route('medecins.edit', $medecin->id_medecin) }}" style="color: #ffc107; text-decoration: none; margin-right: 10px;">Modifier</a>

                                <form action="{{ route('medecins.destroy', $medecin->id_medecin) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer Dr. {{ $medecin->nom }} ?')" 
                                            style="background: none; border: none; color: #dc3545; cursor: pointer; padding: 0;"
                                            {{ $medecin->dossiers_count > 0 ? 'disabled' : '' }}>
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">Aucun médecin enregistré.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
