<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Services\RegisterService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    use PasswordValidationRules;

    protected RegisterService $registerService;
    protected UserService $userService;

    public function __construct(RegisterService $registerService, UserService $userService)
    {
        $this->registerService = $registerService;
        $this->userService = $userService;
    }

    public function register(UserRequest $request)
    {
       return $this->registerService->createUser($request);
    }

    public function index()
    {
       return $this->userService->getAll();
    }
    public function show(Request $request)
    {
        return $this->userService->get($request);
    }
}
