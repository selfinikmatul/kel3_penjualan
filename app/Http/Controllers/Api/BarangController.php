<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Barang::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = Barang::create($request->all());
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Barang::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Barang::find($id);

    if (!$data) {
        return response()->json([
            'message' => 'Barang tidak ditemukan'
        ], 404);
    }

    $data->update($request->all());

    return response()->json([
        'message' => 'Data berhasil diupdate',
        'data' => $data
    ]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Barang::destroy($id);
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
