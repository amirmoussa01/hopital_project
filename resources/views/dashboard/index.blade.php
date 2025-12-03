@extends('layouts.app')

@section('title', 'Tableau de Bord Général')

@section('content')
    <h2 style="margin-bottom: 30px;">Statistiques Clés de l'Hôpital</h2>

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
        
        <div class="card" style="border-left: 5px solid var(--primary-color);">
            <h4 style="border-bottom: none; color: var(--primary-color);">Patients Totaux</h4>
            <div style="font-size: 2.5em; font-weight: bold; margin-top: 10px;">{{ $stats['totalPatients'] }}</div>
        </div>

        <div class="card" style="border-left: 5px solid #ffc107;">
            <h4 style="border-bottom: none; color: #ffc107;">Patients Admis (Actifs)</h4>
            <div style="font-size: 2.5em; font-weight: bold; margin-top: 10px;">{{ $stats['patientsAdmis'] }}</div>
        </div>

        <div class="card" style="border-left: 5px solid var(--secondary-color);">
            <h4 style="border-bottom: none; color: var(--secondary-color);">Taux d'Occupation</h4>
            <div style="font-size: 2.5em; font-weight: bold; margin-top: 10px;">{{ $stats['tauxOccupation'] }}%</div>
        </div>
        
        <div class="card" style="border-left: 5px solid #6c757d;">
            <h4 style="border-bottom: none; color: #6c757d;">Médecins Enregistrés</h4>
            <div style="font-size: 2.5em; font-weight: bold; margin-top: 10px;">{{ $stats['totalMedecins'] }}</div>
        </div>

    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-top: 40px;">

        <div class="card">
            <h3 style="color: var(--primary-color);">Répartition des Statuts Patients</h3>
            
            <div style="height: 120px; border-radius: 6px; overflow: hidden; margin-bottom: 15px; display: flex; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                @php
                    $total = $stats['totalPatients'] > 0 ? $stats['totalPatients'] : 1;
                    $admisPercent = round(($patientStatusData['Admis'] ?? 0) / $total * 100);
                    $consultationPercent = round(($patientStatusData['En Consultation'] ?? 0) / $total * 100);
                    $sortiPercent = round(($patientStatusData['Sorti'] ?? 0) / $total * 100);
                @endphp

                <div style="width: {{ $admisPercent }}%; background: var(--primary-color); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                    @if ($admisPercent > 5) {{ $admisPercent }}% @endif
                </div>
                <div style="width: {{ $consultationPercent }}%; background: #ffc107; display: flex; align-items: center; justify-content: center; color: var(--text-dark); font-weight: bold;">
                    @if ($consultationPercent > 5) {{ $consultationPercent }}% @endif
                </div>
                <div style="width: {{ $sortiPercent }}%; background: #20c997; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                    @if ($sortiPercent > 5) {{ $sortiPercent }}% @endif
                </div>
            </div>

            <div style="display: flex; justify-content: space-around; font-size: 0.9em;">
                <div class="legend-item"><span class="legend-color" style="background: var(--primary-color);"></span>Admis ({{ $patientStatusData['Admis'] ?? 0 }})</div>
                <div class="legend-item"><span class="legend-color" style="background: #ffc107;"></span>En Consultation ({{ $patientStatusData['En Consultation'] ?? 0 }})</div>
                <div class="legend-item"><span class="legend-color" style="background: #20c997;"></span>Sorti ({{ $patientStatusData['Sorti'] ?? 0 }})</div>
            </div>
        </div>


        <div class="card">
            <h3 style="color: var(--primary-color);">Top 5 Activité Médecins (Consultations)</h3>
            
            <div class="chart-container">
                @php
                    // Calcul de la valeur maximale pour normaliser les hauteurs des barres
                    $maxConsultations = max(array_column($consultationsParMedecin, 'count') ?: [1]);
                @endphp
                
                @forelse ($consultationsParMedecin as $medecinData)
                    @php
                        // Hauteur relative, avec une hauteur minimale de 20% pour la visibilité
                        $heightPercent = ($medecinData['count'] / $maxConsultations) * 80 + 20;
                    @endphp
                    <div class="chart-bar" style="height: {{ $heightPercent }}%; background-color: var(--secondary-color);" 
                         title="{{ $medecinData['name'] }}: {{ $medecinData['count'] }} consultations">
                        <span>{{ $medecinData['count'] }}</span>
                        <div style="position: absolute; bottom: -20px; width: 100%; text-align: center; font-size: 0.7em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                             {{ str_replace('Dr. ', '', $medecinData['name']) }}
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">Aucune donnée de consultation pour les médecins.</p>
                @endforelse
            </div>
        </div>

    </div>
    
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px; margin-top: 40px;">
        
        <div class="card">
            <h3 style="color: var(--primary-color);">Activité Récente (5 Dernières Consultations)</h3>
            
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #e9ecef;">
                        <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Heure</th>
                        <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Patient</th>
                        <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Médecin</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dernieresConsultations as $consultation)
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $consultation->date->format('H:i') }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">
                                <a href="{{ route('patients.show', $consultation->patient->id_patient) }}" style="color: var(--text-dark); text-decoration: none;">
                                    {{ $consultation->patient->nom }}
                                </a>
                            </td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Dr. {{ $consultation->medecin->nom }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">
                                <a href="{{ route('patients.show', $consultation->patient->id_patient) }}" style="color: var(--secondary-color); text-decoration: none;">Voir Fiche</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Aucune consultation récente enregistrée.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card">
            <h3 style="color: var(--primary-color);">Indicateurs Opérationnels</h3>
            
            <p><strong>Total Consultations :</strong> <span style="font-size: 1.5em; color: var(--primary-color);">{{ $stats['totalConsultations'] }}</span></p>
            <hr>
            <p><strong>Patients En Consultation :</strong> <span style="font-size: 1.5em; color: #ffc107;">{{ $stats['patientsEnConsultation'] }}</span></p>
            <hr>
            <p><strong>Salles Disponibles :</strong> <span style="font-size: 1.5em; color: var(--secondary-color);">{{ $stats['sallesDisponibles'] }}</span></p>

            <a href="{{ route('admission.create') }}" class="btn" style="width: 100%; text-align: center;">Démarrer une Admission</a>
        </div>
    </div>
@endsection
