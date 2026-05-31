<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Transaksi;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/pesan', function (Request $request) {

    $pelanggan = Pelanggan::create([
        'nama_pelanggan' => $request->nama_pelanggan,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp
    ]);

    $barang = Barang::find($request->id_barang);

    $kode = 'ORD-' . rand(100000,999999);

    Transaksi::create([
        'id_pelanggan' => $pelanggan->id,
        'id_barang' => $barang->id,
        'tanggal' => now(),
        'total_harga' => $barang->harga,
        'user_id' => Auth::id(),
        'kode_pesanan' => $kode,
        'status' => 'Menunggu Scan'
    ]);

    return redirect('/')->with('success', 'Pesanan berhasil dibuat');
});
