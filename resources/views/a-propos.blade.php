
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>À propos - Mini-CMS</title>
</head>
<body>
    <h1>À propos de Mini-CMS</h1>

    <p>Projet de l'Atelier Framework Côté Serveur.</p>

    <p>Auteur : {{ $auteur }}</p>
    <p>Groupe : {{ $groupe }}</p>

    <p>
        <a href="{{ route('home') }}">Accueil</a> |
        <a href="/heure">Heure</a>
    </p>
</body>
</html>
