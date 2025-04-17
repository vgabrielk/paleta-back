<?php

namespace App\Http\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService
{

    public function get($request)
    {
        try {
            $user = User::where('id', $request->user()->id)->firstOrFail();
            $user->load('roles');

            return response()->json($user);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        } catch (\Exception $e) {
            \Log::error('Erro ao buscar usuário', [
                'message' => $e->getMessage(),
                'user_id' => optional($request->user())->id,
            ]);

            return response()->json(['error' => 'Erro ao buscar usuário.', $e->getMessage()], 500);
        }
    }

    public function getAll()
    {
        $user = User::orderBy('id', 'desc')->paginate(10);
        $user->load('roles');
        return $user;
    }

}
