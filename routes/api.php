<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProxyController;
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

Route::name('api')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('.login');

    Route::middleware('auth')->group(function () {
        Route::get('/user', [AuthController::class, 'user'])->name('.user');

        Route::prefix('proxies')
            ->controller(ProxyController::class)
            ->name('.proxies')
            ->group(function () {
                Route::post('/list', 'index')->name('.list');
                Route::post('/export', 'export')->name('.export');
            });
    });
});
