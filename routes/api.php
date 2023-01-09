<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
        Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('vehicles')->group(function () {
            Route::get('/', [App\Http\Controllers\VehicleController::class, 'index']);
            Route::post('/', [App\Http\Controllers\VehicleController::class, 'store']);
            Route::put('/{vehicle}', [App\Http\Controllers\VehicleController::class, 'update']);
            Route::delete('/{vehicle}', [App\Http\Controllers\VehicleController::class, 'delete']);
        });

        Route::prefix('maintenances')->group(function () {
            Route::get('/', [App\Http\Controllers\MaintenanceController::class, 'index']);
            Route::post('/', [App\Http\Controllers\MaintenanceController::class, 'store']);
            Route::put('/{maintenance}', [App\Http\Controllers\MaintenanceController::class, 'update']);
            Route::delete('/{maintenance}', [App\Http\Controllers\MaintenanceController::class, 'delete']);
        });

        Route::prefix('auth')->group(function () {
            Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
        });

        Route::prefix('users')->group(function () {
            Route::get('/me', function (Request $request) {
                return $request->user();
            });
        });
    });
});
