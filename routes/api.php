<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExampleApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\MenuApiController;
use App\Http\Controllers\Api\RoleApiController;
use App\Http\Controllers\Api\InsightApiController;
use App\Http\Controllers\Api\MadrasahApiController;

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('/profile', [UserApiController::class, 'profile']);
        
        Route::get('/users', [UserApiController::class, 'index']);
        Route::post('/users', [AuthController::class, 'register']);
        Route::get('/users/{id}', [UserApiController::class, 'show']);

        Route::get('/menus', [MenuApiController::class, 'index']);
        Route::post('/menus', [MenuApiController::class, 'store']);
        Route::get('/menus/{id}', [MenuApiController::class, 'show']);

        Route::get('/roles', [RoleApiController::class, 'index']);
        Route::post('/roles', [RoleApiController::class, 'store']);
        Route::get('/roles/{id}', [RoleApiController::class, 'show']);

        Route::get('/insights', [InsightApiController::class, 'index']);

        Route::get('/madrasahs', [MadrasahApiController::class, 'index']);
        Route::post('/madrasahs', [MadrasahApiController::class, 'store']);
        Route::get('/madrasahs/{id}', [MadrasahApiController::class, 'show']);
        Route::put('/madrasahs/{id}', [MadrasahApiController::class, 'update']);
        Route::delete('/madrasahs/{id}', [MadrasahApiController::class, 'destroy']);
    });
});
