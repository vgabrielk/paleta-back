<?php
namespace App\Http\Controllers;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController{

    protected AuthService $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }


    public function login(Request $request)
    {
        return $this->authService->auth($request);
    }


    public function logout(Request $request)
    {
       return $this->authService->logout($request);
    }

}
