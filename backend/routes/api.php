<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettlementController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/houses', [HouseController::class, 'index']);
    Route::post('/house/create', [HouseController::class, 'create']);

    Route::post('/settlements', [SettlementController::class, 'index']);
    Route::post('/settlement/create', [SettlementController::class, 'create']);

    Route::middleware('admin')->group(function () {
        Route::post('/house/update', [HouseController::class, 'update']);
        Route::post('/settlement/update', [SettlementController::class, 'update']);
    
        Route::post('/house/delete', [HouseController::class, 'delete']);
        Route::post('/settlement/delete', [SettlementController::class, 'delete']);
    });

    Route::post('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');