<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['nama_status'];
    protected $table = 'status'; 
    protected $primaryKey = 'id_status';

    public function produk()
    {
        return $this->hasMany(Produk::class, 'status_id');
    }
}
