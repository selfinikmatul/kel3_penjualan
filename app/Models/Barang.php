<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    /** @use HasFactory<\Database\Factories\TableBarangFactory> */
    use HasFactory;
     protected $table = 'table_barang';
     protected $fillable = [
        'nama_barang',
        'kategori',
        'harga',
        'stok'
    ];

    // relasi ke transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
