<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        // Ambil data produk dengan eager loading kategori dan status
        $filteredProducts = Produk::with(['kategori', 'status'])->paginate(7);

        // Kirim data produk ke view
        return view('produk.index', compact('filteredProducts'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        // Ambil data kategori dan status untuk dropdown
        $kategoris = Kategori::all();
        $statuses = Status::all();

        // Tampilkan form create
        return view('produk.create', compact('kategoris', 'statuses'));
    }

    /**
     * Menyimpan produk baru ke dalam database.
     */
    public function store(Request $request)
    {
        

        // Validasi data yang diterima
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'exists:kategori,id_kategori',
            'harga' => 'required|numeric|min:0',
            'status_id' => 'exists:status,id_status',
        ]);

        // Cek produk terakhir berdasarkan id_produk
        $lastProduk = Produk::latest('id_produk')->first();
        // Tentukan id_produk baru berdasarkan id terakhir + 1
        $newIdProduk = $lastProduk ? $lastProduk->id_produk + 1 : 1;

        // Simpan data produk baru ke dalam database
        Produk::create([
            'id_produk' => $newIdProduk,
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,  // Ganti dengan kategori_id yang valid
            'harga' => $request->harga,
            'status_id' => $request->status_id,  // Ganti dengan status_id yang valid
        ]);

        // Redirect ke halaman index setelah produk disimpan, dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Mengambil data produk dari API dan menyimpannya ke dalam database.
     */
    public function importFromApi()
    {
        // Dapatkan waktu sekarang dan tambah 1 jam
        $now = Carbon::now()->addHour();

        // Format username dengan tanggal (ymd) dan jam (H), tambahkan C di depan jam
        $username = "tesprogrammer" . $now->format('dmy') . "C" . $now->format('H'); 

        // Format password dengan tanggal yang sudah ditambah 1 jam
        $password = "bisacoding-" . $now->format('d-m-y');
        
        // Terapkan hashing MD5 pada password
        $password = md5($password);

        // Kirim request POST dengan username yang diformat dan password yang di-hash
        $client = new Client();
        $response = $client->request('post', 'https://recruitment.fastprint.co.id/tes/api_tes_programmer', [
            'form_params' => [
                'username' => $username,
                'password' => $password,
            ],
        ]);

        // Decode respons JSON menjadi array
        $responseData = json_decode($response->getBody()->getContents(), true);
        $products = $responseData['data'];

        foreach ($products as $product) {
            // Cek apakah kategori ada di database atau buat baru
            $kategori = Kategori::firstOrCreate(
                ['nama_kategori' => $product['kategori']],
                ['nama_kategori' => $product['kategori']] // Kolom yang akan disimpan jika tidak ada
            );

            // Cek apakah status ada di database atau buat baru
            $status = Status::firstOrCreate(
                ['nama_status' => $product['status']],
                ['nama_status' => $product['status']] // Kolom yang akan disimpan jika tidak ada
            );

            // Pastikan kategori_id dan status_id tidak null sebelum menyimpan produk
            if (!$kategori->id_kategori || !$status->id_status) {
                \Log::error('Kategori atau Status tidak valid', [
                    'kategori' => $kategori,
                    'status' => $status,
                ]);
                continue; // Skip produk ini jika kategori atau status tidak valid
            }

            // Cek apakah produk sudah ada di database berdasarkan nama produk
            $existingProduct = Produk::where('nama_produk', $product['nama_produk'])->first();
            
            // Jika produk sudah ada, lewati pembuatan produk baru
            if ($existingProduct) {
                \Log::info('Produk sudah ada', ['produk' => $existingProduct]);
                continue; // Skip produk ini jika sudah ada di database
            }

            // Simpan produk ke database
            Produk::create([
                'id_produk' => $product['id_produk'],
                'nama_produk' => $product['nama_produk'],
                'harga' => $product['harga'],
                'kategori_id' => $kategori->id_kategori, // Menyimpan id kategori
                'status_id' => $status->id_status, // Menyimpan id status
            ]);
        }

        // Redirect setelah proses import selesai
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diimport dari API');
    }

    /**
     * Menampilkan detail produk (opsional).
     */

    /**
     * Menampilkan form untuk mengedit produk (opsional).
     */
    public function edit($id_produk)
    {
        $product = Produk::where('id_produk', $id_produk)->first();
        $kategoris = Kategori::all();
        $statuses = Status::all();
        return view('produk.edit', compact('product', 'kategoris', 'statuses'));
    }

    /**
     * Mengupdate data produk.
     */
    public function update(Request $request, $id_produk)
    {
       
        $request->validate([
            'nama_produk' => 'string|max:255',
            'kategori_id' => 'exists:kategori,id_kategori',
            'harga' => 'numeric|min:0',
            'status_id' => 'exists:status,id_status',
        ]);
    
        // Find the product by id
        $produk = Produk::where('id_produk', $id_produk)->first();
    
        // Check if the product exists
        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan');
        }
    
        // Update the product
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'status_id' => $request->status_id,
        ]);
    
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }
    


    /**
     * Menghapus produk.
     */
    public function destroy($id_produk)
    {
        // Use the correct column name for 'id_produk'
        $product = Produk::where('id_produk', $id_produk)->first();
    
        if ($product) {
            $product->delete();
            return redirect()->route('produk.index')->with('success', 'Status berhasil dihapus!');
        }
    
        // Return error if the product is not found
        return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan!');
    }

    public function shop()
    {
        // Ambil data produk dengan eager loading kategori dan status, dan filter hanya yang statusnya 'Dijual'
        $filteredProducts = Produk::with(['kategori', 'status'])
            ->whereHas('status', function ($query) {
                $query->where('nama_status', 'bisa dijual');
            })
            ->paginate(8);
    
        // Kirim data produk ke view
        return view('Shop', compact('filteredProducts'));
    }
    
}
