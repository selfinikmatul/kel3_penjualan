<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //validator untuk cek adata yang masuk sesuai requirment atau tidak
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users', //harus unik tidak boleh sama
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) return response()->json($validator->errors(), 422); //error jika validator salah

        $user = User::create([  //memasukan imputan ke tabel user
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), //meng enskripsi password dengan hash
        ]);

        $token = $user->createToken('auth_token')->plainTextToken; //membuiat token auth

        return response()->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer'], 201); //menampilkan pesan sukses
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first(); //cek inputan email ada yang sama tidak seperti di tabel user amnil data pertama

        //jika tidak ada email dan password yang sama maka menampilkan error
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        //membuat token auth untuk login
        $token = $user->createToken('auth_token')->plainTextToken; // men
        //menampilkan pesan sukses
        return response()->json(['message' => 'Login sukses', 'access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function logout(Request $request)
    {
        // Menghapus token yang sedang digunakan
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Berhasil logout']);
    }
}
