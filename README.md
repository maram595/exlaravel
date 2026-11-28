Validation des données avec les Form Requests.

Pages d'erreur personnalisées.

Technologies utilisées

PHP 8.3

Laravel 13

Composer

SQLite

Node.js et npm

Blade

Tailwind CSS

Vite

Git et GitHub

Prérequis

PHP 8.3 ou une version compatible

Composer

Node.js et npm

Git

Installation

Bash (Linux / macOS)

git clone https://github.com/maram595/exlaravel.git
cd exlaravel
composer install
cp .env.example .env
php artisan key:generate
npm install

PowerShell (Windows)

git clone https://github.com/maram595/exlaravel.git
cd exlaravel
composer install
Copy-Item .env.example .env
php artisan key:generate
npm install

Configuration de la base de données

Le projet utilise SQLite.

Vérifier que la configuration du fichier .env correspond à la base de données utilisée.

Si le fichier SQLite n'existe pas encore, le créer :

New-Item database/database.sqlite -ItemType File

Puis exécuter les migrations et les seeders :

php artisan migrate --seed

Lancer le projet

Pour démarrer le serveur Laravel et les outils de développement :

composer run dev

Ouvrir ensuite l'application à l'adresse :

http://localhost:8000

Authentification et rôles

L'application possède deux rôles :

admin : peut gérer les catégories et les tags et administrer les articles.

author : peut gérer ses propres articles selon les autorisations définies.

Les accès sont protégés par les middlewares, les Gates et les Policies.

Routes principales

Méthode

URI

Fonction

GET

/

Page d'accueil

GET

/a-propos

Page à propos

GET

/heure

Affichage de l'heure

GET

/posts

Liste des articles

GET

/posts/create

Formulaire de création

GET

/posts/{post}

Détail d'un article

GET

/connexion

Formulaire de connexion

POST

/connexion

Traitement de la connexion

GET

/inscription

Formulaire d'inscription

POST

/inscription

Traitement de l'inscription

POST

/deconnexion

Déconnexion

GET

/admin/categories

Gestion des catégories

GET

/admin/tags

Gestion des tags

Pour afficher toutes les routes :

php artisan route:list

Tests

Pour exécuter les tests automatisés :

php artisan test

Captures d'écran

Les captures d'écran du projet sont disponibles dans le dossier screenshots/.

Exemples :

s03-accueil.png : page d'accueil.

s03-articles.png : liste des articles.

s03-article.png : détail d'un article.

s10-404.png : page d'erreur 404.

s10-validation.png : validation des formulaires.

Auteur

Nom : Slama Maram

Groupe : MDW32

Licence

Projet pédagogique réalisé dans le cadre de l'Atelier Framework Côté Serveur.
## Comparaison avec le starter kit Livewire

| Fonctionnalité | Mini-CMS | Starter Kit Livewire |
|---|---|---|
| Inscription | RegisterController | Fortify et CreateNewUser |
| Connexion | LoginController | Fortify |
| Déconnexion | LoginController | Action Logout Livewire |
| Protection des routes | Middleware et authentification | Middleware Laravel |
| Limitation des tentatives | Non implémentée | 5 tentatives par minute |
| Mot de passe oublié | Non implémenté | Disponible avec resetPasswords |
| Vérification email | Non implémentée | Disponible avec emailVerification |
| Double authentification | Non implémentée | Disponible avec twoFactorAuthentication |
| Gestion des rôles | Rôle admin, Gates et Policies | À développer |
| Tests | Tests Pest personnalisés | Tests fournis avec le starter kit |

Le starter kit Livewire fournit une base d'authentification plus complète et plusieurs fonctionnalités de sécurité prêtes à l'emploi. Le Mini-CMS utilise une implémentation personnalisée, ce qui permet de mieux comprendre les contrôleurs, les middlewares, les Gates et les Policies.