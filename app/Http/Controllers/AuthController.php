<?php
namespace App\Http\Controllers;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController{


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
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


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }

}
