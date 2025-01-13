<x-layout>
    <x-slot:title>Create New Category</x-slot:title>

    <section class="bg-white dark:bg-gray-900 p-5 sm:p-8">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-16">
            <div class="bg-white dark:bg-gray-800 sm:rounded-lg shadow-lg p-6">
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Category Name</label>
                        <input type="text" name="nama_kategori" id="nama_kategori"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Create</button>
                </form>
            </div>
        </div>
    </section>
</x-layout>
