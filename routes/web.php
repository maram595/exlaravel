
<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/a-propos', [PageController::class, 'about'])->name('about');
Route::get('/heure', [PageController::class, 'time'])->name('time');
// Inscription et connexion
Route::middleware('guest')->group(function () {
    Route::get('/inscription', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/inscription', [RegisterController::class, 'store'])
        ->name('register.store');

    Route::get('/connexion', [LoginController::class, 'create'])
        ->name('login');

    Route::post('/connexion', [LoginController::class, 'store'])
        ->name('login.store');
});

// Déconnexion
Route::post('/deconnexion', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
Route::get('/posts/archive/{year}', [PostController::class, 'archive'])
    ->whereNumber('year')
    ->name('posts.archive');
Route::get('/posts/categorie/{category:slug}', [PostController::class, 'byCategory'])
    ->name('posts.category');
// Routes publiques des articles
Route::resource('posts', PostController::class)
    ->only(['index', 'show']);

// Routes protégées : utilisateurs connectés
Route::middleware(['auth', 'writable'])->group(function () {

    // Création, modification et suppression des articles
    Route::resource('posts', PostController::class)
        ->except(['index', 'show']);

    // Publication des articles
    Route::patch('/posts/{post}/publication', [PostController::class, 'togglePublication'])
        ->name('posts.publication');

    // Administration des catégories et des tags
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::resource('categories', CategoryController::class)->except('show');
        Route::resource('tags', TagController::class)->except('show');
    });

});