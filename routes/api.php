<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExampleApiController;
use App\Http\Controllers\Api\UserApiController;

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
    Route::get('/example', [ExampleApiController::class, 'index']);
    Route::get('/users', [UserApiController::class, 'index']);
});

