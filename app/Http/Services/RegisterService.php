<?php

namespace App\Http\Services;

use App\Http\Requests\UserRequest;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterService
{
    public static function createUser($request): JsonResponse
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
}
