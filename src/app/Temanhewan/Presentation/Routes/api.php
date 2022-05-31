<?php

use App\Temanhewan\Presentation\Controllers\AuthController;
use App\Temanhewan\Presentation\Controllers\CommentController;
use App\Temanhewan\Presentation\Controllers\ForumController;
use App\Temanhewan\Presentation\Controllers\PetController;
use App\Temanhewan\Presentation\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('register', [AuthController::class, 'createUser']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('unauthorized', [AuthController::class, 'unauthorized'])->name('login');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('change-password',[AuthController::class, 'changePassword']);
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

Route::prefix('forum')->group(function () {
    Route::post('get', [ForumController::class, 'getForum']);
    Route::post('public', [ForumController::class, 'getPublicForum']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('create', [ForumController::class, 'createForum']);
        Route::post('my', [ForumController::class, 'getMyForum']);
        Route::post('delete', [ForumController::class, 'deleteForum']);
        Route::post('delete-image', [ForumController::class, 'deleteForumImage']);
        Route::post('update', [ForumController::class, 'updateForum']);
    });
});

Route::prefix('comment')->group(function () {
    Route::post('get', [CommentController::class, 'getComment']);
    Route::post('forum', [CommentController::class, 'getForumComments']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('create', [CommentController::class, 'createComment']);
        Route::post('delete', [CommentController::class, 'deleteComment']);
    });
});
