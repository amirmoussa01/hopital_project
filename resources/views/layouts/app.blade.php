<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HospitelPro - @yield('title')</title>
    <style>
        :root {
            --primary-color: #007bff; /* Bleu hôpital principal */
            --secondary-color: #28a745; /* Vert succès/action */
            --bg-light: #f4f7f6; /* Arrière-plan clair */
            --bg-dark: #34495e; /* Sidebar sombre */
            --text-light: #ecf0f1; /* Texte sidebar clair */
            --text-dark: #2c3e50; /* Texte principal sombre */
        }

        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: var(--bg-light); 
            color: var(--text-dark); 
            margin: 0; 
            padding: 0; 
            display: flex; /* Utilisation de Flexbox pour le layout */
            min-height: 100vh;
        }

        /* --- SIDEBAR (Barre Latérale de Navigation) --- */
        .sidebar {
            width: 250px;
            background-color: var(--bg-dark);
            color: var(--text-light);
            padding: 20px 0;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            transition: width 0.3s ease;
            position: sticky;
            top: 0;
        }

        .sidebar h1 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 30px;
            font-size: 1.5em;
            border-bottom: 1px solid #4a637a;
            padding-bottom: 15px;
        }

        .sidebar nav a {
            display: block;
            color: var(--text-light);
            text-decoration: none;
            padding: 15px 20px;
            margin: 5px 0;
            transition: background-color 0.3s ease, color 0.3s ease;
            border-left: 5px solid transparent;
        }

        /* Effet hover attirant */
        .sidebar nav a:hover {
            background-color: #4a637a;
            color: var(--primary-color);
            border-left: 5px solid var(--primary-color);
        }

        /* --- MAIN CONTENT & HEADER --- */
        .main-container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        header {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            color: var(--text-dark);
            font-size: 1.2em;
            font-weight: bold;
        }

        .content {
            padding: 30px;
            flex-grow: 1;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        h1, h2, h3 { 
            color: var(--primary-color); 
            border-bottom: 2px solid #eee; 
            padding-bottom: 10px; 
            margin-top: 20px; 
        }

        /* --- FORM STYLES --- */
        label { display: block; margin-top: 10px; font-weight: 600; color: var(--text-dark); }
        input[type="text"], input[type="number"], input[type="email"], select, textarea { 
            width: 100%; 
            padding: 12px; 
            margin-top: 5px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            box-sizing: border-box; 
            transition: border-color 0.3s ease;
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        /* --- BUTTONS --- */
        button, .btn { 
            background-color: var(--secondary-color); 
            color: white; 
            padding: 12px 20px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            margin-top: 20px; 
            font-size: 1em; 
            transition: background-color 0.3s ease, transform 0.1s;
        }
        button:hover, .btn:hover { 
            background-color: #1e7e34; 
            transform: translateY(-1px); /* Petite animation */
        }
        .btn-warning { background-color: #ffc107; color: var(--text-dark); }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-danger { background-color: #dc3545; }
        .btn-danger:hover { background-color: #c82333; }

        /* --- MESSAGES & ALERTS --- */
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px; margin-bottom: 20px; border-radius: 4px; animation: fadeIn 0.5s; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        
        /* --- ANIMATION SIMPLE (Exemple) --- */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    
    <div class="sidebar">
        <h1>Hospitel-Pro</h1>
        <nav>
            <p style="color: #bbb; padding: 0 20px; margin-top: 20px; font-size: 0.9em;">NAVIGATION PRINCIPALE</p>
            <a href="{{ url('/') }}">Tableau de Bord</a>
            <a href="{{ route('patients.index') }}">Patients</a>
            <a href="{{ route('consultations.index') }}">Consultations</a>
            
            <p style="color: #bbb; padding: 0 20px; margin-top: 20px; font-size: 0.9em;">GESTION & ADMISSION</p>
            <a href="{{ route('admission.create') }}">Admission Rapide</a>
            <a href="{{ route('medecins.index') }}">Médecins</a>
            <a href="{{ route('salles.index') }}">Salles & Chambres</a>

            <p style="color: #bbb; padding: 0 20px; margin-top: 20px; font-size: 0.9em;">POSTES OPÉRATIONNELS</p>
            <a href="{{ route('pharmacie.index') }}">Pharmacie</a>
            <a href="{{ route('caisse.index') }}">Caisse & Facturation</a>
        </nav>
    </div>

    <div class="main-container">
        <header>
            @yield('title', 'Bienvenue sur le Tableau de Bord')
        </header>
        
        <div class="content">
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
    </div>
</body>
</html>
