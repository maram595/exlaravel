<x-layout>
    <x-slot:title>Connexion</x-slot:title>

    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Connexion</h1>

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block mb-1">Email</label>
                <input id="email" type="email" name="email"
                       value="{{ old('email') }}"
                       class="w-full border rounded p-2">
                @error('email')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-1">Mot de passe</label>
                <input id="password" type="password" name="password"
                       class="w-full border rounded p-2">
                @error('password')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                Se connecter
            </button>
        </form>

        <p class="mt-4">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-indigo-600">S'inscrire</a>
        </p>
    </div>
</x-layout>