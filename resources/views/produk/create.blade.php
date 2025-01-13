<x-layout>
    <x-slot:title>Tambah Produk</x-slot:title>

    <section class="bg-white dark:bg-gray-900 p-5 sm:p-8">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-16">
            <div class="bg-white dark:bg-gray-800 sm:rounded-lg shadow-lg p-6">

                <!-- Form Tambah Produk -->
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-6">Tambah Produk Baru</h2>

                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <!-- Nama Produk -->
                        <div>
                            <label for="nama_produk" class="block text-sm font-medium text-gray-900 dark:text-white">Nama
                                Produk</label>
                            <input type="text" id="nama_produk" name="nama_produk" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                            <select id="kategori_id" name="kategori_id"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Harga -->
                        <div>
                            <label for="harga"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                            <input type="number" id="harga" name="harga" required min="0" step="1000"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select id="status_id" name="status_id"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id_status }}">{{ $status->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Button Submit -->
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Simpan
                            Produk</button>
                    </div>
                </form>

                <div class="mt-4">
                    <a href="{{ route('produk.index') }}" class="text-blue-600 hover:text-blue-800">Kembali ke Daftar
                        Produk</a>
                </div>

            </div>
        </div>
    </section>
</x-layout>
