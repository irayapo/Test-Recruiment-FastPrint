<x-layout>
    <x-slot:title>Daftar Produk</x-slot:title>

    <section class="bg-white dark:bg-gray-900 p-5 sm:p-8">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-16">
            <div class="bg-white dark:bg-gray-800 sm:rounded-lg shadow-md p-6">

                <!-- Daftar Produk -->
                <div class="overflow-x-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Daftar Produk</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($filteredProducts as $product)
                            <div
                                class="product-item bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out p-6 hover:bg-gray-100 dark:hover:bg-gray-700">

                                <!-- Product Info -->
                                <p class="text-sm text-gray-700 font-medium"><strong>ID Produk:</strong>
                                    {{ $product['id_produk'] }}</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ \Str::limit($product['nama_produk'], 50) }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Kategori:</strong>
                                    {{ $product->kategori->nama_kategori }}
                                </p>
                                <p class="text-lg font-semibold text-green-600"><strong>Harga:</strong> Rp.
                                    {{ number_format($product['harga'], 0, ',', '.') }}</p>
                                <p class="text-sm italic text-gray-600 dark:text-gray-400"><strong>Status:</strong>
                                    {{ $product->status->nama_status }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-6">
                    {{ $filteredProducts->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </section>

    <!-- Icon Keranjang dan History Payment di Pojok Bawah -->
    <div class="fixed bottom-5 right-5 space-x-4 flex items-center">
        <!-- Ikon Keranjang -->
        <a href="#"
            class="flex items-center justify-center w-16 h-16 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out relative">
            <span class="text-lg sm:text-xl">🛒</span>
            {{-- @if ($cartCount > 0)
                <span class="absolute top-0 right-0 text-xs font-semibold bg-red-600 text-white rounded-full px-2 py-1">
                    {{ $cartCount }}
                </span>
            @endif --}}
        </a>
        <!-- Ikon History Payment -->
        <a href="#"
            class="flex items-center justify-center w-16 h-16 bg-green-600 text-white rounded-full shadow-lg hover:bg-green-700 transition duration-300 ease-in-out">
            <span class="text-lg sm:text-xl">💳</span>
        </a>
    </div>
</x-layout>
