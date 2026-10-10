# Mini-CMS — Atelier Framework Côté Serveur

Projet fil rouge réalisé avec **Laravel 13** dans le cadre de l’Atelier Framework Côté Serveur.

## Présentation

Mini-CMS est une application web développée avec Laravel. Ce projet permet de découvrir les bases du développement côté serveur avec PHP et le framework Laravel.

## Technologies utilisées

- PHP 8.3
- Laravel 13
- Composer
- Node.js et npm
- Blade
- Git et GitHub

## Prérequis

- PHP 8.3 ou version compatible
- Composer
- Node.js et npm
- Git

## Installation

### Bash (Linux / macOS)

```bash
git clone https://github.com/maram595/exlaravel.git
cd exlaravel
composer install
cp .env.example .env
php artisan key:generate
npm install
```

### PowerShell (Windows)

```powershell
git clone https://github.com/maram595/exlaravel.git
cd exlaravel
composer install
Copy-Item .env.example .env
php artisan key:generate
npm install
```

## Lancer le projet

```bash
composer run dev
```

Ouvrir ensuite l’application à l’adresse : http://localhost:8000

## Routes disponibles

- `/` : page d’accueil
- `/bonjour` : page Bonjour
- `/bonjour-court` : message court
- `/bienvenue` : page de bienvenue
- `/version` : informations sur la version
- `/heure` : heure et date actuelles
- `/a-propos` : présentation du projet et de son auteur

## Auteur

- **Nom :** Slama Maram
- **Groupe :** MDW32

## Licence

Projet pédagogique réalisé dans le cadre de l’Atelier Framework Côté Serveur.
