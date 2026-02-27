<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class usercontroller extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'User not found'], 401);
        }

        return response()->json(['message' => 'User found', 'user' => $user], 200);
    }
}
