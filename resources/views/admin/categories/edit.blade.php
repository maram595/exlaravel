
<x-layout>
    <x-slot:title>Modifier une catégorie - Mini-CMS</x-slot:title>

    <h1 class="text-3xl font-bold text-gray-900">
        Modifier une catégorie
    </h1>

    <form action="{{ route('admin.categories.update', $category) }}"
          method="POST"
          class="mt-6 max-w-xl space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-medium text-gray-700">
                Nom
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $category->name) }}"
                class="mt-1 w-full rounded-md border border-gray-300 p-2"
            >

            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="slug" class="block font-medium text-gray-700">
                Slug
            </label>

            <input
                type="text"
                id="slug"
                name="slug"
                value="{{ old('slug', $category->slug) }}"
                class="mt-1 w-full rounded-md border border-gray-300 p-2"
            >

            @error('slug')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="rounded-md bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700">
            Enregistrer
        </button>

        <a href="{{ route('admin.categories.index') }}"
           class="ml-3 text-indigo-600 hover:underline">
            Annuler
        </a>
    </form>
</x-layout>
