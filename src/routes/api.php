<?php

use App\Http\Api\Controllers\AdminController;
use App\Http\Api\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);

    //Liffアプリでログイン後のAPIを叩く際にJWTの認証を通すためのRoute
    Route::middleware('verify.JWT')->group(function () {
        Route::get(('/dummy/{dummyId}'), [AdminController::class, 'dummy']);
        Route::post(('/dummy'), [AdminController::class, 'dummyPost']);
    });

    // ログイン済みのみ
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout']);

        Route::prefix('admins')->group(function () {
            // Route::middleware(['can:admin'])->group(function () {
            // Route::get('/', [UserController::class, 'index']);
            Route::get('/{adminID}', [AdminController::class, 'show'])->where('adminID', '[0-9]+');
            // Route::post('/', [UserController::class, 'store']);
            // Route::put('/{id}', [UserController::class, 'update'])->where('id', '[0-9]+');
            // Route::delete('/{id}', [UserController::class, 'destroy'])->where('id', '[0-9]+');
            // });
        });
    });
});
