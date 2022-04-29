<?php

use App\Temanhewan\Presentation\Controllers\UserController;
use App\Temanhewan\Presentation\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::post('/create-user', 'createUser');
});

Route::controller(PetController::class)->group(function () {
    Route::post('/create-pet', 'createPet');
});
