<x-layout>
    <x-slot:title>Modifier un tag - Mini-CMS</x-slot:title>

    <h1 class="text-3xl font-bold text-gray-900">Modifier un tag</h1>

    <form action="{{ route('admin.tags.update', $tag) }}" method="POST" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-medium text-gray-700">Nom</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $tag->name) }}"
                   class="mt-1 w-full rounded-lg border-gray-300 shadow-sm">

            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="slug" class="block font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" id="slug"
                   value="{{ old('slug', $tag->slug) }}"
                   class="mt-1 w-full rounded-lg border-gray-300 shadow-sm">

            @error('slug')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
            Mettre à jour
        </button>

        <a href="{{ route('admin.tags.index') }}"
           class="ml-3 text-gray-600 hover:underline">
            Annuler
        </a>
    </form>
</x-layout>