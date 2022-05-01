<?php

use App\Temanhewan\Presentation\Controllers\UserController;
use App\Temanhewan\Presentation\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('register', [UserController::class, 'createUser']);
    Route::post('login', [UserController::class, 'login']);
    Route::get('unauthorized', [UserController::class, 'unauthorized'])->name('login');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [UserController::class, 'logout']);
    });
});

Route::middleware('auth:sanctum')->prefix('pet')->group(function () {
    Route::post('create', [PetController::class, 'createPet']);
});
