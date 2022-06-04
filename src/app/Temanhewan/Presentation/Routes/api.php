<?php

use App\Temanhewan\Presentation\Controllers\AuthController;
use App\Temanhewan\Presentation\Controllers\CommentController;
use App\Temanhewan\Presentation\Controllers\ConsultationController;
use App\Temanhewan\Presentation\Controllers\ForumController;
use App\Temanhewan\Presentation\Controllers\PetController;
use App\Temanhewan\Presentation\Controllers\UserController;
use \App\Temanhewan\Presentation\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('register', [AuthController::class, 'createUser']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('unauthorized', [AuthController::class, 'unauthorized'])->name('login');
    Route::post('public',[UserController::class, 'getPublicUser']);
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
        Route::post('update', [CommentController::class, 'updateComment']);
        Route::post('delete', [CommentController::class, 'deleteComment']);
        Route::post('delete-image', [CommentController::class, 'deleteCommentImage']);
    });
});

Route::prefix('consultation')->group(function(){
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('create', [ConsultationController::class, 'createConsultation']);
        Route::post('accept', [ConsultationController::class, 'acceptConsultation']);
        Route::post('cancel', [ConsultationController::class, 'cancelConsultation']);
        Route::post('reject', [ConsultationController::class, 'rejectConsultation']);
        Route::post('paid', [ConsultationController::class, 'paidConsultation']);
        Route::post('complete', [ConsultationController::class, 'completeConsultation']);
        Route::prefix('review')->group(function () {
            Route::post('create', [ConsultationController::class, 'createConsultationReview']);
        });
    });
});

Route::prefix('doctor')->group(function(){
    Route::post('reviews', [DoctorController::class, 'getReviews']);
    Route::post('list', [DoctorController::class, 'getDoctors']);
    Route::post('get', [DoctorController::class, 'getDoctor']);
    Route::middleware('auth:sanctum')->group(function () {
    });
});
