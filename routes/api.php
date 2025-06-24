<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExampleApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\MenuApiController;

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/example', [ExampleApiController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/users', [UserApiController::class, 'index']);
        Route::post('/users', [AuthController::class, 'register']);
        Route::get('/menus', [MenuApiController::class, 'index']);
    });
});
