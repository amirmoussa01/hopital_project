@extends('layouts.app')

@section('title', 'Dashboard Patient')

@section('content')
<div class="container mt-5">
    <h3>Bienvenue, {{ auth('patient')->user()->nom }} !</h3>

    <p class="mt-3">
        Ceci est votre espace patient.  
        À terme vous verrez ici :
        <ul>
            <li>Vos rendez-vous</li>
            <li>Vos consultations</li>
            <li>Ordonnances</li>
            <li>Résultats d’examens</li>
        </ul>
    </p>

    <form method="POST" action="{{ route('patient.logout') }}">
        @csrf
        <button class="btn btn-danger">Se déconnecter</button>
    </form>
</div>
@endsection