<?php
declare(strict_types=1);

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::prefix('auth')
        ->as('auth.')
        ->controller(AuthController::class)
        ->group(function () {
            Route::post('login', 'login');
        });
});
?>
