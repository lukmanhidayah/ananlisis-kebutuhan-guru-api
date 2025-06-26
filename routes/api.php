<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\MenuApiController;
use App\Http\Controllers\Api\RoleApiController;
use App\Http\Controllers\Api\InsightApiController;
use App\Http\Controllers\Api\MadrasahApiController;
use App\Http\Controllers\Api\MadrasahLevelApiController;
use App\Http\Controllers\Api\ClassLevelApiController;
use App\Http\Controllers\Api\SubjectApiController;
use App\Http\Controllers\Api\AcademicYearApiController;
use App\Http\Controllers\Api\RegencyApiController;
use App\Http\Controllers\Api\DistrictApiController;
use App\Http\Controllers\Api\VillageApiController;

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

        Route::get('/madrasah-levels', [MadrasahLevelApiController::class, 'index']);
        Route::post('/madrasah-levels', [MadrasahLevelApiController::class, 'store']);
        Route::get('/madrasah-levels/{id}', [MadrasahLevelApiController::class, 'show']);
        Route::put('/madrasah-levels/{id}', [MadrasahLevelApiController::class, 'update']);
        Route::delete('/madrasah-levels/{id}', [MadrasahLevelApiController::class, 'destroy']);

        Route::get('/class-levels', [ClassLevelApiController::class, 'index']);
        Route::post('/class-levels', [ClassLevelApiController::class, 'store']);
        Route::get('/class-levels/{id}', [ClassLevelApiController::class, 'show']);
        Route::put('/class-levels/{id}', [ClassLevelApiController::class, 'update']);
        Route::delete('/class-levels/{id}', [ClassLevelApiController::class, 'destroy']);

        Route::get('/subjects', [SubjectApiController::class, 'index']);
        Route::post('/subjects', [SubjectApiController::class, 'store']);
        Route::get('/subjects/{id}', [SubjectApiController::class, 'show']);
        Route::put('/subjects/{id}', [SubjectApiController::class, 'update']);
        Route::delete('/subjects/{id}', [SubjectApiController::class, 'destroy']);

        Route::get('/regencies', [RegencyApiController::class, 'index']);
        Route::get('/districts', [DistrictApiController::class, 'index']);
        Route::get('/villages', [VillageApiController::class, 'index']);

        Route::get('/academic-years', [AcademicYearApiController::class, 'index']);
        Route::post('/academic-years', [AcademicYearApiController::class, 'store']);
        Route::get('/academic-years/{id}', [AcademicYearApiController::class, 'show']);
        Route::put('/academic-years/{id}', [AcademicYearApiController::class, 'update']);
        Route::delete('/academic-years/{id}', [AcademicYearApiController::class, 'destroy']);
    });
});
