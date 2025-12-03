<!DOCTYPE html>
<html>
<head>
    <title>Connexion Admin</title>
</head>
<body>
    <h2>Connexion Admin</h2>

    @if ($errors->any())
        <div style="color:red;">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST">
        @csrf

        <input type="email" name="email" placeholder="Email"><br><br>
        <input type="password" name="password" placeholder="Mot de passe"><br><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>