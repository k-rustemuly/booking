<?php
declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HousingController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::prefix('auth')
        ->as('auth.')
        ->controller(AuthController::class)
        ->group(function () {
            Route::post('login', 'login');
        });

    Route::middleware('auth')->group(function () {
        Route::apiResource('housings', HousingController::class);
        Route::apiResource('bookings', BookingController::class);
    });
});
?>
