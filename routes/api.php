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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);

    Route::prefix('proxies')
        ->controller(ProxyController::class)
        ->group(function () {
            Route::post('/list', 'index');
            Route::post('/export', 'export');
        });
});
