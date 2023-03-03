<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('/task')->group(function () {
    Route::get('/', [TaskController::class, 'list']);
    Route::get('/{id}', [TaskController::class, 'single']);
    Route::post('/', [TaskController::class, 'store']);
//    Route::patch('/update', [TaskController::class, 'update']);
//    Route::get('/delete/{id}', [TaskController::class, 'destroy']);
});
