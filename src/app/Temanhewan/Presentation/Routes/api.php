<?php

use App\Temanhewan\Presentation\Controllers\UserController;
use App\Temanhewan\Presentation\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::post('user/register', 'createUser');
});

Route::controller(PetController::class)->group(function () {
    Route::post('pet/create', 'createPet');
});
