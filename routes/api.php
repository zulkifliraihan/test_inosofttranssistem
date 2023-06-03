<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\StokController;
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

Route::get('/kendaraan', [KendaraanController::class, 'index']);
Route::post('/kendaraan', [KendaraanController::class, 'create']);
Route::get('/kendaraan/{id}', [KendaraanController::class, 'detail']);
Route::put('/kendaraan/{id}', [KendaraanController::class, 'update']);
Route::delete('/kendaraan/{id}', [KendaraanController::class, 'delete']);

Route::get('/stok', [StokController::class, 'index']);
Route::post('/stok', [StokController::class, 'create']);
Route::get('/stok/{id}', [StokController::class, 'detail']);
Route::put('/stok/{id}', [StokController::class, 'update']);
Route::delete('/stok/{id}', [StokController::class, 'delete']);


Route::prefix('customer')->group(function () {
    Route::get('/', [CustomerController::class, 'index']);
    Route::post('/', [CustomerController::class, 'create']);
    Route::get('/{id}', [CustomerController::class, 'detail']);
    Route::put('/{id}', [CustomerController::class, 'update']);
    Route::delete('/{id}', [CustomerController::class, 'delete']);
});
