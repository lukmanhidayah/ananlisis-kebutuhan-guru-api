<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExampleApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\MenuApiController;
use App\Http\Controllers\Api\RoleApiController;
use App\Http\Controllers\Api\InsightApiController;

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/users', [UserApiController::class, 'index']);
        Route::post('/users', [AuthController::class, 'register']);
        Route::get('/profile', [UserApiController::class, 'profile']);
        Route::get('/users/{id}', [UserApiController::class, 'show']);

        Route::get('/menus', [MenuApiController::class, 'index']);
        Route::post('/menus', [MenuApiController::class, 'store']);
        Route::get('/menus/{id}', [MenuApiController::class, 'show']);

        Route::get('/roles', [RoleApiController::class, 'index']);
        Route::get('/roles/{id}', [RoleApiController::class, 'show']);

        Route::get('/insights', [InsightApiController::class, 'index']);
    });
});
