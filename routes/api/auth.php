<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

//Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
//Route::post('/verification', [AuthController::class, 'verify']);
Route::get('/logout', [AuthController::class, 'logout']);
