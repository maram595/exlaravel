# Cycle de vie d'une requête Laravel

1. `public/index.php` : point d'entrée de la requête HTTP.
2. `vendor/autoload.php` : charge automatiquement les classes PHP.
3. `bootstrap/app.php` : initialise l'application Laravel.
4. `routes/web.php` : reconnaît la route `/heure`.
5. `resources/views/heure.blade.php` : génère le HTML avec l'heure et la date.
6. Laravel renvoie la réponse au navigateur.