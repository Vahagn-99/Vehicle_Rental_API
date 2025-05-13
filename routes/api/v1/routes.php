<?php

use App\Http\Controllers\Api\V1\{
    RenterController,
    VehicleController,
};
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::prefix('renters')->group(function () {
        Route::get('/balance', [RenterController::class, 'balance']);
        Route::get('/history', [RenterController::class, 'rentalHistory']);
        Route::get('/operations', [RenterController::class, 'operationsHistory']);
        Route::patch('/balance', [RenterController::class, 'updateBalance']);
    });

    Route::prefix('vehicles')->group(function () {
        Route::get('/availables', [VehicleController::class, 'availables']);
        Route::get('{id}', [VehicleController::class, 'item']);
        Route::patch('{id}/status', [VehicleController::class, 'updateStatus']);
        Route::patch('{id}/location', [VehicleController::class, 'updateLocation']);
    });
});

