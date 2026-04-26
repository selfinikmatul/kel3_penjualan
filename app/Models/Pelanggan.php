<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    /** @use HasFactory<\Database\Factories\TablePelangganFactory> */
    use HasFactory;
     protected $table = 'table_pelanggan';
     protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'no_hp'
    ];

    // relasi ke transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
