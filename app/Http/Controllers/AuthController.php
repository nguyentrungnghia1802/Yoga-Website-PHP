<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'user_name' => ['required', 'string'],
            'password'  => ['required', 'string'],
        ]);

        $user = User::where('user_name', $data['user_name'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'user_name' => ['Sai tài khoản hoặc mật khẩu.'],
            ]);
        }

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'user'       => ['id' => $user->id, 'user_name' => $user->user_name],
            'token'      => $token,
            'token_type' => 'Bearer',
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
