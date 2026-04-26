<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_penjualan = Transaksi::sum('total_harga');
        $jumlah_transaksi = Transaksi::count();
        $jumlah_barang = Barang::count();
        $jumlah_pelanggan = Pelanggan::count();

        return response()->json([
            'total_penjualan' => $total_penjualan,
            'jumlah_transaksi' => $jumlah_transaksi,
            'jumlah_barang' => $jumlah_barang,
            'jumlah_pelanggan' => $jumlah_pelanggan
        ]);
    }
}
