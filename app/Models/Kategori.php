<?php
namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori'];
    protected $table = 'kategori'; 
    protected $primaryKey = 'id_kategori';
 

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}
