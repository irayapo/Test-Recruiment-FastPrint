<?php

namespace App\Models;

use App\Models\Status;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    /** @use HasFactory<\Database\Factories\Mfs\ProdukFactory> */
    use HasFactory;
    protected $table = 'produk'; 
    protected $fillable = ['id_produk', 'nama_produk', 'harga', 'kategori_id', 'status_id'];
    protected $primaryKey = 'id_produk';


    // Definisikan relasi dengan kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Definisikan relasi dengan status
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
