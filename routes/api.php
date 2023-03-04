<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')
    ->group(function () {
        Route::controller(AuthController::class)
        ->name('auth')
        ->group(function () {
            Route::get('user', fn (Request $request) => $request->user());
            Route::post('login', 'login')->withoutMiddleware('auth:api');
            Route::post('register', 'register')->withoutMiddleware('auth:api');
            Route::post('logout', 'logout');
            Route::post('refresh', 'refresh');
        });

        Route::controller(AddressController::class)
            ->name('addresses')
            ->group(function () {
                Route::post('addresses', 'store');
                Route::put('addresses/{address}', 'update');
                Route::delete('addresses/{address}', 'destroy');
            });
    });
