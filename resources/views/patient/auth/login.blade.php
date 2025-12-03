@extends('layouts.app')

@section('title', 'Connexion Patient')

@section('content')
<div class="container mt-5 col-md-4">

    <h3 class="text-center mb-4">Connexion Patient</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('patient.login.submit') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Se connecter</button>

        <p class="text-center mt-3">
            Pas de compte ?
            <a href="{{ route('patient.register') }}">Créer un compte</a>
        </p>

    </form>
</div>
@endsection