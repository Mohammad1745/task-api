<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->prefix('/task')->group(function () {
    Route::get('/', [TaskController::class, 'list']);
    Route::get('/{id}', [TaskController::class, 'single']);
    Route::post('/store', [TaskController::class, 'store']);
    Route::post('/update', [TaskController::class, 'update']);
    Route::get('/delete/{id}', [TaskController::class, 'destroy']);
});
