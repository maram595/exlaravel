
<x-layout>
    <x-slot:title>Catégories - Mini-CMS</x-slot:title>

    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900">
            Gestion des catégories
        </h1>

        <a href="{{ route('admin.categories.create') }}"
           class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
            Ajouter une catégorie
        </a>
    </div>

    <div class="mt-6 overflow-x-auto rounded-lg border border-gray-200 bg-white">
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3">Nom</th>
                    <th class="px-4 py-3">Slug</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-3">{{ $category->name }}</td>
                        <td class="px-4 py-3">{{ $category->slug }}</td>

                        <td class="px-4 py-3">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="text-indigo-600 hover:underline">
                                Modifier
                            </a>

                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                  method="POST"
                                  class="inline-block ml-3"
                                  onsubmit="return confirm('Supprimer cette catégorie ?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-red-600 hover:underline">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                            Aucune catégorie disponible.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
