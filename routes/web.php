<?php

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {

    $total_penjualan = Transaksi::sum('total_harga');
    $jumlah_barang = Barang::count();
    $jumlah_transaksi = Transaksi::count();
    $jumlah_pelanggan = Pelanggan::count();

    return view('dashboard', compact(
        'total_penjualan',
        'jumlah_barang',
        'jumlah_transaksi',
        'jumlah_pelanggan'
    ));
});

Route::get('/produk', function () {

    $barang = \App\Models\Barang::all();

    return view('produk', compact('barang'));
});

Route::get('/produk/tambah', function () {
    return view('tambah_produk');
});

Route::post('/produk/store', function (Request $request) {

    Barang::create([
        'nama_barang' => $request->nama_barang,
        'kategori' => $request->kategori,
        'harga' => $request->harga,
        'stok' => $request->stok
    ]);

    return redirect('/produk');

});

Route::get('/produk/edit/{id}', function ($id) {

    $barang = \App\Models\Barang::findOrFail($id);

    return view('edit_produk', compact('barang'));
});

Route::post('/produk/update/{id}', function (Illuminate\Http\Request $request, $id) {

    $barang = \App\Models\Barang::findOrFail($id);

    $barang->update([
        'nama_barang' => $request->nama_barang,
        'kategori' => $request->kategori,
        'harga' => $request->harga,
        'stok' => $request->stok
    ]);

    return redirect('/produk');
});

Route::get('/produk/hapus/{id}', function ($id) {

    \App\Models\Barang::destroy($id);

    return redirect('/produk');
});



Route::get('/pesanan', function () {

    $transaksi = Transaksi::with(['pelanggan', 'barang'])->get();

    return view('pesanan', compact('transaksi'));
});



Route::get('/login', function () {
    return view('login');
});

Route::post('/login-proses', function (Request $request) {

    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {
        return redirect('/dashboard');
    }

    return back()->with('error', 'Email atau Password salah');

});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::get('/', function () {

    $barang = \App\Models\Barang::all();

    return view('user', compact('barang'));
});

Route::get('/beli/{id}', function ($id) {

    $barang = Barang::findOrFail($id);

    return view('beli', compact('barang'));
});

Route::post('/pesan', function (Request $request) {

    $pelanggan = Pelanggan::create([
        'nama_pelanggan' => $request->nama_pelanggan,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp
    ]);

    $barang = Barang::find($request->id_barang);

    Transaksi::create([
    'user_id' => Auth::id() ?? 1,
    'id_pelanggan' => $pelanggan->id,
    'id_barang' => $barang->id,
    'tanggal' => now(),
    'total_harga' => $barang->harga
]);

    return redirect('/')->with('success', 'Pesanan berhasil dibuat');

});
