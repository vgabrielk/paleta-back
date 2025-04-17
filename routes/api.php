<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\PublishPortfolioController;


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/users', [UserController::class, 'index'])->middleware('role:admin');
    Route::get('/user', [UserController::class, 'show']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('portfolio', [PortfolioController::class, 'index']);
    Route::post('portfolio', [PortfolioController::class, 'store']);
    Route::get('portfolio/{id}', [PortfolioController::class, 'show']);
    Route::put('portfolio/{portfolio}', [PortfolioController::class, 'update']);
    Route::get('portfolio/url/{portfolioUrl}', [PortfolioController::class, 'showByUrl']);
    Route::delete('portfolio/{id}', [PortfolioController::class, 'destroy']);

    Route::get('templates', [TemplateController::class, 'index']);
    Route::get('templates/{id}', [TemplateController::class, 'show']);

    Route::post('portfolio/{portfolio}/publish', [PublishPortfolioController::class, 'publish']);
    Route::post('portfolio/unpublish/{portfolio}', [PublishPortfolioController::class, 'unpublish']);
});
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/auth/check', function () {
    return response()->json(['message' => 'Authenticated'], 200);
});
