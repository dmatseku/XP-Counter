<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\XpController;
use Illuminate\Support\Facades\Route;

Route::middleware('forceJsonResponse')->group(function () {
    Route::post('/start', [AuthController::class, 'start']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/progress', [XpController::class, 'progress']);
        Route::post('/earn', [XpController::class, 'earn']);
    });
});
