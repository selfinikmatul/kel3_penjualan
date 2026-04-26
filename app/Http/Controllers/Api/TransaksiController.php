<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        return response()->json(
            Transaksi::with(['pelanggan','barang'])->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['tanggal'] = Carbon::parse($request->tanggal)->format('Y-m-d');
        $data['user_id'] = 3;

        $transaksi = Transaksi::create($data);

        return response()->json(
            Transaksi::with(['pelanggan','barang'])->find($transaksi->id)
        );
    }

    public function show(string $id)
    {
        return response()->json(
            Transaksi::with(['pelanggan','barang'])->find($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $data = Transaksi::find($id);
        $data->update($request->all());

        return response()->json(
            Transaksi::with(['pelanggan','barang'])->find($id)
        );
    }

    public function destroy(string $id)
    {
        Transaksi::destroy($id);

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
