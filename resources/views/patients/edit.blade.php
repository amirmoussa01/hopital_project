@extends('layouts.app')

@section('title', 'Modifier Patient')

@section('content')
    <a href="{{ route('patients.index') }}">← Retour à la Liste des Patients</a>

    <h2>Modifier le Profil de {{ $patient->prenom }} {{ $patient->nom }}</h2>
    
    <form method="POST" action="{{ route('patients.update', $patient->id_patient) }}">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <h3>Informations de Base</h3>
                <label for="nom">Nom :</label>
                <input type="text" name="nom" value="{{ old('nom', $patient->nom) }}" required>

                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" value="{{ old('prenom', $patient->prenom) }}" required>
                
                <label for="age">Âge :</label>
                <input type="number" name="age" value="{{ old('age', $patient->age) }}" min="0">
            </div>

            <div>
                <h3>Contacts et Statut</h3>
                <label for="tel">Téléphone :</label>
                <input type="text" name="tel" value="{{ old('tel', $patient->tel) }}">

                <label for="email">Email :</label>
                <input type="email" name="email" value="{{ old('email', $patient->email) }}">
                
                <label for="statut">Statut :</label>
                <select name="statut" required>
                    @foreach (['Admis', 'En_Consultation', 'En_Traitement', 'Sorti'] as $statut)
                        <option value="{{ $statut }}" {{ old('statut', $patient->statut) == $statut ? 'selected' : '' }}>
                            {{ str_replace('_', ' ', $statut) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div style="margin-top: 20px;">
            <h3>Placement Actuel</h3>
            <label for="id_salle">Salle/Chambre :</label>
            <select name="id_salle">
                <option value="0">-- Non attribuée --</option>
                @foreach ($salles as $salle)
                    <option value="{{ $salle->id_salle }}" {{ old('id_salle', $patient->id_salle) == $salle->id_salle ? 'selected' : '' }}>
                        {{ $salle->type }} (ID: {{ $salle->id_salle }})
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" style="background-color: #ffc107; color: #333; margin-top: 20px;">Sauvegarder les Modifications</button>
    </form>
@endsection
