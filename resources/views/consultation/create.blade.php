@extends('layouts.app')

@section('title', 'Nouvelle Consultation')

@section('content')
    <h2>Nouvelle Consultation</h2>
    <h3>Patient : <span style="color: #28a745;">{{ $patient->prenom }} {{ $patient->nom }} (ID: {{ $patient->id_patient }})</span></h3>
    
    <form method="POST" action="{{ route('consultation.store', $patient->id_patient) }}">
        @csrf

        <div style="background: #f0f0f0; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
            <label for="id_medecin" style="font-weight: bold; color: #007bff; display: inline;">
                Médecin Traitant :
            </label>
            <select name="id_medecin" required style="width: auto; padding: 8px;">
                <option value="">-- Choisir un Médecin --</option>
                @foreach ($medecins as $medecin)
                    <option value="{{ $medecin->id_medecin }}" {{ old('id_medecin') == $medecin->id_medecin ? 'selected' : '' }}>
                        Dr. {{ $medecin->prenom }} {{ $medecin->nom }} ({{ $medecin->specialite ?? 'Généraliste' }})
                    </option>
                @endforeach
            </select>
        </div>
        
        <label for="consultation_resume">Symptômes et Résumé de Consultation (Obligatoire) :</label><br>
        <textarea name="consultation_resume" rows="10" cols="100" required>{{ old('consultation_resume') }}</textarea>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
            <div>
                <label for="prescription">Prescription Médicaments (Pharmacie) :</label><br>
                <textarea name="prescription" rows="10" cols="50">{{ old('prescription') }}</textarea>
            </div>
            <div>
                <label for="examen">Examens Demandés (Caisse) :</label><br>
                <textarea name="examen" rows="10" cols="50">{{ old('examen') }}</textarea>
            </div>
        </div>
        
        <button type="submit" style="background-color: #007bff;">Enregistrer le Dossier Médical et Terminer la Consultation</button>
    </form>
@endsection
