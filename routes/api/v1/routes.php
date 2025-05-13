<?php

use App\Http\Controllers\Api\V1\{
    RenterController,
};
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::prefix('renters')->group(function () {
        Route::get('/balance', [RenterController::class, 'balance']);
        Route::get('/history', [RenterController::class, 'rentalHistory']);
        Route::get('/operations', [RenterController::class, 'operationsHistory']);
        Route::patch('/balance', [RenterController::class, 'updateBalance']);
    });
});

