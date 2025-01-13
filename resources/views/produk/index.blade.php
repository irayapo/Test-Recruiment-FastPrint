<x-layout>
    <x-slot:title>Daftar Produk</x-slot:title>

    <style>
        /* Mengatur kolom agar teks panjang tidak meluber */
        .truncate-text {
            display: block;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Menyembunyikan teks panjang pada awalnya */
        .full-text {
            display: none;
        }

        /* Responsif untuk perangkat kecil */
        @media (max-width: 768px) {

            th,
            td {
                padding: 6px;
                /* Menambah padding pada tabel */
            }

            .truncate-text {
                max-width: none;
                white-space: normal;
            }

            table {
                font-size: 14px;
                /* Menyesuaikan ukuran font pada perangkat kecil */
            }
        }
    </style>

    <section class="bg-white dark:bg-gray-900 p-5 sm:p-8">

        <!-- Daftar Produk -->
        <div class="overflow-x-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Daftar Produk</h2>
                <a href="produk/create"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Tambah
                    Produk</a>
            </div>
            <table class="min-w-full table-auto border-separate border-spacing-0">
                <thead class="bg-gray-100 dark:bg-gray-700 uppercase text-left whitespace-nowrap">
                    <tr>
                        <th class="px-2 text-md font-medium text-gray-900 dark:text-white">No</th>
                        <!-- Menambahkan Kolom No -->
                        <th class="px-2 text-md font-medium text-gray-900 dark:text-white">ID Produk</th>
                        <th class="px-2 text-md font-medium text-gray-900 dark:text-white">Nama Produk</th>
                        <th class="px-2 text-md font-medium text-gray-900 dark:text-white">Kategori</th>
                        <th class="px-2 text-md font-medium text-gray-900 dark:text-white">Harga</th>
                        <th class="px-2 text-md font-medium text-gray-900 dark:text-white">Status</th>
                        <th class="px-2 text-md font-medium text-gray-900 dark:text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filteredProducts as $product)
                        <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-2 text-sm text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
                            <td class="px-2 text-sm text-gray-900 dark:text-white">{{ $product['id_produk'] }}</td>
                            <td class="px-2 text-sm text-gray-900 dark:text-white">
                                <span class="block truncate max-w-xs" id="product-name-{{ $loop->index }}"
                                    data-product-id="{{ $loop->index }}">{{ $product['nama_produk'] }}</span>
                                <span class="hidden full-text" id="full-text-{{ $loop->index }}"
                                    data-product-id="{{ $loop->index }}">{{ $product['nama_produk'] }}</span>
                                <button class="text-blue-500 text-sm mt-1"
                                    onclick="toggleText({{ $loop->index }})">Read More</button>
                            </td>
                            <td class="px-2 text-sm text-gray-600 dark:text-gray-400">
                                {{ $product->kategori->nama_kategori }}
                            </td>
                            <td class="px-2 text-sm text-green-600">Rp.
                                {{ number_format($product['harga'], 0, ',', '.') }}</td>
                            <td class="px-2 text-sm">
                                @if ($product->status->nama_status === 'bisa dijual')
                                    <span class="px-2 bg-green-600 text-white rounded-full font-semibold">
                                        {{ $product->status->nama_status }}
                                    </span>
                                @elseif ($product->status->nama_status === 'tidak bisa dijual')
                                    <span class="px-2 bg-red-600 text-white rounded-full font-semibold">
                                        {{ $product->status->nama_status }}
                                    </span>
                                @else
                                    <span class="px-2 bg-gray-600 text-white rounded-full font-semibold">
                                        {{ $product->status->nama_status }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-md text_center mr-10">
                                <a href="{{ route('produk.edit', $product->id_produk) }}"
                                    class="text-blue-600 hover:text-blue-800 transition duration-300">Edit</a>
                                <form action="/produk/{{ $product->id_produk }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn-delete text-red-600 hover:text-red-800">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $filteredProducts->links('pagination::tailwind') }}
        </div>
    </section>
</x-layout>

<script>
    function toggleText(index) {
        const truncatedText = document.getElementById(`product-name-${index}`);
        const fullText = document.getElementById(`full-text-${index}`);
        const button = document.querySelector(`button[data-product-id="${index}"]`);

        if (fullText.classList.contains('hidden')) {
            fullText.classList.remove('hidden');
            truncatedText.classList.add('hidden');
            button.textContent = "Show Less";
        } else {
            fullText.classList.add('hidden');
            truncatedText.classList.remove('hidden');
            button.textContent = "Read More";
        }
    }
</script>
