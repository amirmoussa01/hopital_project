@extends('layouts.app')

@section('title', 'Journal des Consultations')

@section('content')
    <h2>Journal de Toutes les Consultations</h2>
    
    <div style="background: #f8f8f8; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
        <h3>Filtres Rapides</h3>
        <form method="GET" action="{{ route('consultations.index') }}" style="display: flex; gap: 20px; align-items: flex-end;">

            <div>
                <label for="id_patient">Filtrer par Patient :</label>
                <select name="id_patient" onchange="this.form.submit()">
                    <option value="">-- Tous les Patients --</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id_patient }}" 
                                {{ $active_patient_id == $patient->id_patient ? 'selected' : '' }}>
                            {{ $patient->nom }} {{ $patient->prenom }} (ID: {{ $patient->id_patient }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="id_medecin">Filtrer par Médecin :</label>
                <select name="id_medecin" onchange="this.form.submit()">
                    <option value="">-- Tous les Médecins --</option>
                    @foreach ($medecins as $medecin)
                        <option value="{{ $medecin->id_medecin }}" 
                                {{ $active_medecin_id == $medecin->id_medecin ? 'selected' : '' }}>
                            Dr. {{ $medecin->nom }} (ID: {{ $medecin->id_medecin }})
                        </option>
                    @endforeach
                </select>
            </div>
            
            @if ($active_patient_id || $active_medecin_id)
                <a href="{{ route('consultations.index') }}" style="color: #dc3545; text-decoration: none; padding-bottom: 5px;">
                     Réinitialiser les Filtres
                </a>
            @endif
        </form>
    </div>

    <h3>Résultats ({{ $consultations->count() }} Consultations Affichées)</h3>
    
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #343a40; color: white;">
                <th style="padding: 10px; border: 1px solid #ddd;">Date & Heure</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Patient</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Médecin</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Résumé Dossier</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Détails</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($consultations as $consultation)
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">
                        {{ $consultation->date->format('d/m/Y H:i') }}
                    </td>
                    <td style="padding: 10px; border: 1px solid #ddd;">
                        <a href="{{ route('patients.show', $consultation->patient->id_patient) }}">
                            {{ $consultation->patient->nom }} {{ $consultation->patient->prenom }}
                        </a>
                    </td>
                    <td style="padding: 10px; border: 1px solid #ddd;">
                        Dr. {{ $consultation->medecin->nom }}
                    </td>
                    <td style="padding: 10px; border: 1px solid #ddd;">
                        {{ \Illuminate\Support\Str::limit($consultation->dossier->consultation_resume ?? 'N/A', 80) }}
                    </td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                        <a href="{{ route('patients.show', $consultation->patient->id_patient) }}#dossier-{{ $consultation->dossier->id_dossier ?? 'N/A' }}" 
                           style="color: #007bff; text-decoration: none;">
                            Voir Dossier N°{{ $consultation->dossier->id_dossier ?? 'N/A' }}
                        </a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align: center;">Aucune consultation trouvée pour ces critères.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
