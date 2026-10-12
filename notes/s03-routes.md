# Session 03 - Routes, contrôleurs et layout

## Défi

**1. URL produite par `route('about')` :**

`/a-propos`

**2. URL produite par `route('posts.show', 'routes-et-controleurs')` :**

`/posts/routes-et-controleurs`

**3. URL produite par `route('posts.archive', 2025)` :**

`/posts/archive/2025`

**4. Pourquoi `/posts/archive/abc` et `/posts/article-inconnu` répondent toutes deux 404, et quelle ligne de code en est responsable dans chaque cas ?**

- `/posts/archive/abc` renvoie 404 car `whereNumber('year')` refuse une valeur non numérique.
- `/posts/article-inconnu` renvoie 404 car `abort_unless(isset($posts[$slug]), 404)` dans `PostController::show()` refuse un slug inconnu.

**5. Que se passe-t-il si une vue appelle `route('posts.show')` sans paramètre ?**

Laravel déclenche une exception `UrlGenerationException`, car la route attend le paramètre obligatoire `{slug}`.