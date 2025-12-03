@extends('layouts.app')

@section('title', 'Liste des Patients')

@section('content')
    <h2>Panel de Gestion des Patients</h2>
    
    <a href="{{ route('admission.create') }}" style="background-color: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; display: inline-block; margin-bottom: 20px;">
        Admettre un Nouveau Patient
    </a>
    
    <h3>Liste Complète des Patients ({{ $patients->count() }})</h3>
    
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #007bff; color: white;">
                <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Patient (Nom, Prénom)</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Statut</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Salle</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Dernier Dossier</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($patients as $patient)
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $patient->id_patient }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">
                        <strong>{{ $patient->nom }} {{ $patient->prenom }}</strong>
                        <small> ({{ $patient->age }} ans)</small>
                    </td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                        <span style="font-weight: bold; color: {{ $patient->statut == 'Sorti' ? '#dc3545' : ($patient->statut == 'Admis' ? '#ffc107' : '#28a745') }};">
                            {{ $patient->statut }}
                        </span>
                    </td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $patient->salle->type ?? 'N/A' }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $patient->id_dossier ?? 'Aucun' }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                        <a href="{{ route('patients.show', $patient->id_patient) }}" style="color: #007bff; text-decoration: none; margin-right: 10px;">Voir Fiche</a>
                        <a href="{{ route('patients.edit', $patient->id_patient) }}" style="color: #ffc107; text-decoration: none; margin-right: 10px;">Modifier</a>

                        <form action="{{ route('patients.destroy', $patient->id_patient) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{ $patient->nom }} et tout son historique ?')" 
                                    style="background: none; border: none; color: #dc3545; cursor: pointer; padding: 0;"
                                    {{ $patient->dossiers()->count() > 0 ? 'disabled' : '' }}>
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Aucun patient n'est actuellement enregistré.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
