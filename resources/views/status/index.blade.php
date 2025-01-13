<x-layout>
    <x-slot:title></x-slot:title>

    <section class="bg-white dark:bg-gray-900 p-5 sm:p-8">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-16">
            <div class="bg-white dark:bg-gray-800 sm:rounded-lg shadow-lg p-6">

                <!-- Form untuk Menambah Status -->
                <div class="mb-4 mt-3">
                    <h3><strong>Tambah Status</strong></h3>
                    <form action="{{ route('status.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_status"></label>
                            <input type="text" class="form-control" id="nama_status" name="nama_status" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </div>

                <!-- Tabel Daftar Status -->
                <h3>Daftar Status</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statuses as $status)
                            <tr id="row-{{ $status->id_status }}">
                                <td>{{ $loop->iteration }}</td>
                                <td id="status-text-{{ $status->id_status }}">
                                    <!-- Inline Edit Form -->
                                    @if ($status->id_status == old('status_id', null) || session('edit_status') == $status->id_status)
                                        <form action="{{ route('status.update', $status->id_status) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" class="form-control" name="nama_status"
                                                value="{{ old('nama_status', $status->nama_status) }}" required>
                                            <button type="submit" class="btn btn-success btn-sm">Perbarui</button>
                                        </form>
                                    @else
                                        {{ $status->nama_status }}
                                    @endif
                                </td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-warning btn-sm edit-btn"
                                        data-id="{{ $status->id_status }}"
                                        onclick="editStatus({{ $status->id_status }})">Edit</button>

                                    <!-- Button Hapus -->
                                    <form action="{{ route('status.destroy', $status->id_status) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete text-red-600 hover:text-red-800"
                                            onclick="confirmDelete({{ $status->id_status }})">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </section>

    <script>
        function editStatus(statusId) {
            // Add statusId to session or hidden field to trigger edit mode
            let url = '{{ route('status.edit', ':id') }}';
            url = url.replace(':id', statusId);
            window.location.href = url;
        }
    </script>

</x-layout>
