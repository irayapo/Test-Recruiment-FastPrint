<!DOCTYPE html>
<html lang="id" class="h-full bg-white font-Roboto">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.27/dist/sweetalert2.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen flex bg-gray-100">

    <!-- Sidebar -->
    <div class="w-64  bg-gray-800 text-white h-full p-5 top-0">
        <div class="text-3xl font-bold mb-8">FastPrint</div>
        <ul>
            <li id="dashboard" class="sidebar-item mb-4 hover:bg-gray-700 p-2 rounded">
                <a href="/Shop">Dashboard</a>
            </li>
            <li id="produk" class="sidebar-item mb-4 hover:bg-gray-700 p-2 rounded">
                <a href="/produk">Produk</a>
            </li>
            <li id="kategori" class="sidebar-item mb-4 hover:bg-gray-700 p-2 rounded">
                <a href="/kategori">Kategori</a>
            </li>
            <li id="status" class="sidebar-item mb-4 hover:bg-gray-700 p-2 rounded">
                <a href="/status">Status</a>
            </li>
        </ul>
    </div>

    <!-- Main content -->
    <main class="flex-1 p-6">
        <div class="bg-white shadow-sm p-4 rounded-lg">
            {{ $slot }}
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.27/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menambahkan kelas active pada menu sidebar saat diklik
        document.addEventListener('DOMContentLoaded', function() {
            // Menambahkan event listener pada elemen sidebar
            const sidebarItems = document.querySelectorAll('.sidebar-item');

            sidebarItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Menghapus kelas 'active' dari semua item sidebar
                    sidebarItems.forEach(item => item.classList.remove('bg-gray-700'));

                    // Menambahkan kelas 'active' pada item yang diklik
                    this.classList.add('bg-gray-700');
                });
            });
        });

        // SweetAlert untuk flash message (added, edited, success, error)
        @if (session('added'))
            Swal.fire({
                title: "Berhasil!",
                text: "Berhasil menambahkan data baru!",
                icon: "success",
                confirmButtonText: "OK"
            });
        @elseif (session('edited'))
            Swal.fire({
                title: "Berhasil!",
                text: "Berhasil mengedit data!",
                icon: "success",
                confirmButtonText: "OK"
            });
        @elseif (session('success'))
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        @elseif (session('error'))
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK"
            });
        @elseif (session('message'))
            Swal.fire({
                title: "Info!",
                text: "{{ session('message') }}",
                icon: "info",
                confirmButtonText: "OK"
            });
        @elseif (session('btn-delete'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('btn-delete') }}",
                icon: 'success',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            });
        @endif

        // SweetAlert untuk validasi error
        @if ($errors->any())
            Swal.fire({
                title: 'Kesalahan Validasi!',
                html: `
                <ul style="text-align: left; margin: 0; padding: 0; list-style: none;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>

</body>

</html>
