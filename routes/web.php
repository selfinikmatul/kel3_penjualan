<?php

use Illuminate\Support\Facades\Route;
use App\Models\Barang;

Route::get('/', function () {

    $barang = Barang::all();

    return view('user', compact('barang'));
});
