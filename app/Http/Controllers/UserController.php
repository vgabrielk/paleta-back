<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use PasswordValidationRules;

    public function register(UserRequest $request): JsonResponse
    {
        try {
            $role = $request->role;

            $user = DB::transaction(function () use ($request, $role) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'tenant_id' => null,
                ]);

                $slug = Str::slug($user->name);
                $domain = "{$slug}-{$user->id}.paleta.io";

                $tenant = Tenant::create([
                    'id' => Str::uuid(),
                    'name' => $request->name,
                    'domain' => $domain,
                ]);
                $tenant->refresh();
                $user->tenant_id = $tenant->id;
                $user->save();

                $user->assignRole($role ?? 'admin');

                return $user;
            });

            return response()->json($user->load(['roles']), 201);

        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Erro ao registrar usuário', [
                'message' => $e->getMessage(),
                'email' => $request->email
            ]);

            return response()->json([
                'error' => 'Erro ao registrar usuário.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        $user = User::orderBy('id', 'desc')->paginate(10);
        $user->load('roles');
        return $user;

    }
    public function show(Request $request)
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
}
