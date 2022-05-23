<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return response()->json([
        "status" => true,
        "message" => "success"
    ]);
});

$path = app_path('Temanhewan/Presentation/Routes/api.php');
require "{$path}";
