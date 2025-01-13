<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua data status dari database
        $statuses = Status::all();

        // Menampilkan view dengan data status dan status yang sedang diedit
        return view('status.index', compact('statuses'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_status' => 'required|string|max:255',
        ]);

        // Menyimpan data status baru ke database
        Status::create([
            'nama_status' => $request->input('nama_status'),
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('status.index')->with('success', 'Status berhasil ditambahkan!');
    }


    public function edit($id)
{
    // Find the status by its ID
    $status = Status::where('id_status', $id)->first();

    // Return the view with the status data
    return view('status.edit', compact('status'));
}

    public function update(Request $request, Status $status)
    {
        // Validasi input
        $request->validate([
            'nama_status' => 'required|string|max:255',
        ]);

        // Memperbarui data status di database
        $status->update([
            'nama_status' => $request->input('nama_status'),
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('status.index')->with('success', 'Status berhasil diperbarui!');
    }

    public function destroy(Status $status)
    {
        // Menghapus status dari database
        $status->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('status.index')->with('success', 'Status berhasil dihapus!');
    }
}
