<x-layout>
    <x-slot:title>Edit Category</x-slot:title>

    <section class="bg-white dark:bg-gray-900 p-5 sm:p-8">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-16">
            <div class="bg-white dark:bg-gray-800 sm:rounded-lg shadow-lg p-6">
                <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Category Name</label>
                        <input type="text" name="nama_kategori" id="nama_kategori"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-lg"
                            value="{{ $kategori->nama_kategori }}" required>
                    </div>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Update</button>
                </form>

                <div class="mb-4 mt-3">
                    <a href="/kategori" class="inline-block bg-gray-500 text-white px-4 py-2 rounded-lg">Back to
                        Previous Page</a>
                </div>
            </div>
        </div>
    </section>
</x-layout>
