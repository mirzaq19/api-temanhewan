<?php

use App\Temanhewan\Presentation\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::post('/create-user', 'createUser');
});
