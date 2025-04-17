<?php

namespace App\Http\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService
{

    public static function auth($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::with(['roles', 'tenant'])->where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Senha incorreta.'], 401);
        }

        $token = $user->createToken('auth_token')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public static function logout($request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }
}
