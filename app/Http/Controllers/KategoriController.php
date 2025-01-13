<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua data kategori
        $kategori = Kategori::all();

        // Menampilkan view dengan data kategori
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        // Menampilkan form untuk membuat kategori baru
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Menyimpan kategori baru
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // Redirect ke halaman index
        return redirect()->route('kategori.index');
    }

    public function edit($id)
    {
        // Menampilkan form untuk mengedit kategori
        $kategori = Kategori::where('id_kategori', $id)->first();
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Menyimpan perubahan kategori
        $kategori = Kategori::where('id_kategori', $id)->first();
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // Redirect ke halaman index
        return redirect()->route('kategori.index');
    }

    public function destroy($id)
    {
        // Menghapus kategori
        $kategori = Kategori::where('id_kategori', $id)->first();
        $kategori->delete();

        // Redirect ke halaman index
        return redirect()->route('kategori.index')->with('btn-delete', 'Berhasil dihapus !!!');
    }
}
