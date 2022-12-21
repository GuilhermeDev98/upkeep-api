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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
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
});
