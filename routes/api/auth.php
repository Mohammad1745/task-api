<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

//Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verification', [AuthController::class, 'verify']);

Route::middleware('auth:api')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
});
