<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostController;

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

Route::prefix('/')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('signin', [AuthController::class, 'signIn']);
    });
    Route::apiResource('users', UserController::class);
    Route::prefix('users/{user}')->group(function () {
        Route::apiResource('posts', UserPostController::class);
    });
});
