<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ProjectController;


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/users', [UserController::class, 'index'])->middleware('role:admin');
    Route::get('/user', [UserController::class, 'show']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('portfolio', [PortfolioController::class, 'index']);
    Route::post('portfolio', [PortfolioController::class, 'store']);
    Route::get('portfolio/{id}', [PortfolioController::class, 'show']);
    Route::put('portfolio/{id}', [PortfolioController::class, 'update']);
    Route::delete('portfolio/{id}', [PortfolioController::class, 'destroy']);

    Route::post('portfolio/{portfolio_id}/project', [ProjectController::class, 'store']);
    Route::put('project/{id}', [ProjectController::class, 'update']);
    Route::delete('project/{id}', [ProjectController::class, 'destroy']);

    Route::get('templates', [TemplateController::class, 'index']);
    Route::get('templates/{id}', [TemplateController::class, 'show']);

});
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/auth/check', function () {
    return response()->json(['message' => 'Authenticated'], 200);
});
