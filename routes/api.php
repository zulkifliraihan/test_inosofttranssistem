<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PenjualanController;
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

Route::prefix('auth')->group(function () {
    Route::middleware(['auth.jwt'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth.jwt'])->group(function () {
        Route::prefix('kendaraan')->group(function () {
            Route::get('/', [KendaraanController::class, 'index']);
            Route::post('/', [KendaraanController::class, 'create']);
            Route::get('/{id}', [KendaraanController::class, 'detail']);
            Route::put('/{id}', [KendaraanController::class, 'update']);
            Route::delete('/{id}', [KendaraanController::class, 'delete']);
        });


        Route::prefix('customer')->group(function () {
            Route::get('/', [CustomerController::class, 'index']);
            Route::post('/', [CustomerController::class, 'create']);
            Route::get('/{id}', [CustomerController::class, 'detail']);
            Route::put('/{id}', [CustomerController::class, 'update']);
            Route::delete('/{id}', [CustomerController::class, 'delete']);
        });

        Route::prefix('penjualan')->group(function () {
            Route::get('/', [PenjualanController::class, 'index']);
            Route::get('/laporan', [PenjualanController::class, 'laporan']);
            Route::post('/', [PenjualanController::class, 'create']);
            Route::get('/{id}', [PenjualanController::class, 'detail']);
            Route::put('/{id}', [PenjualanController::class, 'update']);
            Route::delete('/{id}', [PenjualanController::class, 'delete']);
        });
});
