<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash; // WAJIB untuk cek password terenkripsi

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Ambil data user berdasarkan email
        $user = user::where('email', $request->email)->first();

        // 2. Verifikasi: User ditemukan DAN password cocok
        // Hash::check akan membandingkan '123456' dengan kode acak di database
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau Password salah'
            ], 401);
        }

        // 3. Buat Token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }
}
