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

Route::name('api.')->group(function () {
    Route::post('/calculations', App\Http\Controllers\Calculation\StoreController::class)->name('calculations.store');
    Route::get('/calculations', App\Http\Controllers\Calculation\IndexController::class)->name('calculations.get');
    Route::delete('/calculations/{calculation}', App\Http\Controllers\Calculation\DestroyController::class)->name('calculations.destroy');
    Route::delete('/calculations', App\Http\Controllers\Calculation\DestroyAllController::class)->name('calculations.destroy-all');
});
