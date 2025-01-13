<!-- resources/views/status/edit.blade.php -->

<x-layout>
    <x-slot:title>Edit Status</x-slot:title>

    <section class="bg-white dark:bg-gray-900 p-5 sm:p-8">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-16">
            <div class="bg-white dark:bg-gray-800 sm:rounded-lg shadow-lg p-6">

                <!-- Edit Form -->
                <h3><strong>Edit Status</strong></h3>
                <form action="{{ route('status.update', $status->id_status) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_status">Status</label>
                        <input type="text" class="form-control" id="nama_status" name="nama_status"
                            value="{{ old('nama_status', $status->nama_status) }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">Perbarui</button>
                </form>

                <div class="mb-4 mt-3">
                    <a href="/status" class="inline-block bg-gray-500 text-white px-4 py-2 rounded-lg">Back to
                        Previous Page</a>
                </div>
            </div>
        </div>
    </section>
</x-layout>
