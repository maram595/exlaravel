<x-layout>
    <x-slot:title>Tags - Mini-CMS</x-slot:title>

    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900">Tags</h1>

        <a href="{{ route('admin.tags.create') }}"
           class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
            Créer un tag
        </a>
    </div>

    @if (session('success'))
        <div class="mt-4 rounded-lg bg-green-100 p-4 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-6 overflow-hidden rounded-lg bg-white shadow">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">Nom</th>
                    <th class="px-6 py-3 text-left">Slug</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($tags as $tag)
                    <tr>
                        <td class="px-6 py-4">{{ $tag->name }}</td>
                        <td class="px-6 py-4">{{ $tag->slug }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.tags.edit', $tag) }}"
                               class="text-indigo-600 hover:underline">
                                Modifier
                            </a>

                            <form action="{{ route('admin.tags.destroy', $tag) }}"
                                  method="POST"
                                  class="ml-3 inline">
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
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                            Aucun tag.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>