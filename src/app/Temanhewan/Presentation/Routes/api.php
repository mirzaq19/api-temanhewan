<?php

use App\Temanhewan\Presentation\Controllers\AuthController;
use App\Temanhewan\Presentation\Controllers\ForumController;
use App\Temanhewan\Presentation\Controllers\PetController;
use App\Temanhewan\Presentation\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('register', [AuthController::class, 'createUser']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('unauthorized', [AuthController::class, 'unauthorized'])->name('login');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('update', [UserController::class, 'update']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get', [UserController::class, 'get']);
    });
});

Route::middleware('auth:sanctum')->prefix('pet')->group(function () {
    Route::post('create', [PetController::class, 'createPet']);
    Route::post('get', [PetController::class, 'getPet']);
    Route::post('update',[PetController::class,'updatePet']);
    Route::post('list', [PetController::class, 'listPet']);
    Route::post('delete', [PetController::class, 'deletePet']);
});

Route::middleware('auth:sanctum')->prefix('forum')->group(function () {
    Route::post('create', [ForumController::class, 'createForum']);
});
