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
    try {

        $data = $request->all();

        // tanggal otomatis hari ini
        $data['tanggal'] = now()->format('Y-m-d');

        // sementara user tetap
        $data['user_id'] = 3;

        // default status
        if(!isset($data['status'])){
            $data['status'] = 'Menunggu Scan';
        }

        // kode pesanan otomatis
        if(!isset($data['kode_pesanan'])){
            $data['kode_pesanan'] =
                'ORD-' . rand(100000,999999);
        }

        $transaksi = Transaksi::create($data);

        return response()->json(
            Transaksi::with([
                'pelanggan',
                'barang'
            ])->find($transaksi->id)
        );

    } catch (\Exception $e) {

        return response()->json([
            'error' => $e->getMessage()
        ],500);

    }
}

    public function show(string $id)
    {
        return response()->json(
            Transaksi::with(['pelanggan','barang'])->find($id)
        );
    }
    public function scan($kode)
{
    $pesanan = Transaksi::with([
        'pelanggan',
        'barang'
    ])
    ->where('kode_pesanan', $kode)
    ->get();

    return response()->json($pesanan);
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
