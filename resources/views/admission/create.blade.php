@extends('layouts.app')

@section('title', 'Admission d\'un nouveau patient')

@section('content')
    <h2>Enregistrement d'un Nouveau Patient</h2>
    
    <form method="POST" action="{{ route('admission.store') }}">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <h3>Informations de Base</h3>
                <label for="nom">Nom :</label>
                <input type="text" name="nom" value="{{ old('nom') }}" required>

                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" value="{{ old('prenom') }}" required>
                
                <label for="age">Âge :</label>
                <input type="number" name="age" value="{{ old('age') }}" min="0">
            </div>

            <div>
                <h3>Contacts et Placement</h3>
                <label for="tel">Téléphone :</label>
                <input type="text" name="tel" value="{{ old('tel') }}">

                <label for="email">Email :</label>
                <input type="email" name="email" value="{{ old('email') }}">

                <label for="id_salle">Salle/Chambre (Facultatif) :</label>
                <select name="id_salle">
                    <option value="">-- Non attribuée --</option>
                    @foreach ($salles as $salle)
                        <option value="{{ $salle->id_salle }}" {{ old('id_salle') == $salle->id_salle ? 'selected' : '' }}>
                            {{ $salle->type }} (ID: {{ $salle->id_salle }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <button type="submit">Procéder à l'Admission</button>
    </form>
@endsection
