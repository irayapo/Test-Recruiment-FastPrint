<x-layout>
    <x-slot:title>Manage Categories</x-slot:title>

    <section class="bg-white dark:bg-gray-900 p-5 sm:p-8">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-16">
            <div class="bg-white dark:bg-gray-800 sm:rounded-lg shadow-lg p-6">
                <!-- Button to open create category modal -->
                <div class="mb-4 text-right">
                    <a href="{{ route('kategori.create') }}"
                        class="inline-block bg-blue-500 text-white px-4 py-2 rounded-lg">Create New Category</a>
                </div>

                <!-- Categories Table -->
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">ID Kategori</th>
                            <th class="px-4 py-2 text-left">Nama Kategori</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $kat)
                            <tr>
                                <td class="px-4 py-2">{{ $kat->id_kategori }}</td>
                                <td class="px-4 py-2">{{ $kat->nama_kategori }}</td>
                                <td class="px-4 py-2">
                                    <!-- Edit button -->
                                    <a href="{{ route('kategori.edit', $kat->id_kategori) }}"
                                        class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-lg">Edit</a>

                                    <!-- Delete button -->
                                    <form action="{{ route('kategori.destroy', $kat->id_kategori) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class=btn-delete text-red-600
                                            hover:text-red-800>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-layout>
