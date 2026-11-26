
<x-layout>
    <x-slot:title>Accueil - Mini-CMS</x-slot:title>

    <h1 class="text-3xl font-bold">Bienvenue sur Mini-CMS</h1>

    <p class="mt-4 text-gray-700">
        Mini-CMS est le projet fil rouge de l'Atelier Framework Côté Serveur (Laravel 13).
    </p>

    <p class="mt-6">
        <a href="{{ route('about') }}" class="text-red-600 underline">
            En savoir plus sur le projet
        </a>
    </p>

    <h2 class="text-2xl font-bold mb-4 mt-10">
        Parcourir par catégorie
    </h2>

    <ul class="mb-10 flex flex-wrap gap-3" aria-label="Catégories">
        @foreach ($categories as $category)
            <li>
                <a
                    href="{{ route('posts.category', $category) }}"
                    class="inline-block rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 hover:border-indigo-600 hover:text-indigo-600"
                >
                    {{ $category->name }} ({{ $category->posts_count }})
                </a>
            </li>
        @endforeach
    </ul>

</x-layout>
