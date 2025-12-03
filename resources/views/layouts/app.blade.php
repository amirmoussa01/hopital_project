<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HospitelPro - @yield('title')</title>
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f4f7f6; color: #333; margin: 0; padding: 0; }
        .container { width: 80%; margin: 20px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.05); }
        header { background: #007bff; color: white; padding: 15px 0; text-align: center; margin-bottom: 20px; }
        nav a { color: white; margin: 0 15px; text-decoration: none; font-weight: bold; }
        h1, h2, h3 { color: #007bff; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-top: 20px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="number"], input[type="email"], select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #28a745; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; margin-top: 20px; font-size: 16px; }
        button:hover { background-color: #218838; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; margin-bottom: 20px; border-radius: 4px; }
    </style>
</head>
<body>
    <header>
        <h1>HospitelPro - Plateforme de Gestion</h1>
        <nav>
            <a href="{{ route('medecins.create') }}">Enregistrer Medecin</a>
            <a href="{{ route('admission.create') }}">Admettre Patient</a>
            <a href="{{ route('salles.index') }}">Gérer les Salles</a> 
            <a href="{{ route('caisse.index') }}">Caisse</a> 
            <a href="{{ route('pharmacie.index') }}">Pharmacie</a> 
        </nav>

    </header>
    
    <div class="container">
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert-error">
                <strong>Erreur(s) de validation :</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @yield('content')
    </div>
</body>
</html>
