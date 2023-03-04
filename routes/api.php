<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')
    ->get('/user', function (Request $request) {
        return $request->user();
    });

Route::controller(AuthController::class)
    ->name('auth')
    ->middleware('auth:api')
    ->group(function () {
        Route::post('login', 'login')->withoutMiddleware('auth:api');
        Route::post('register', 'register')->withoutMiddleware('auth:api');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });
