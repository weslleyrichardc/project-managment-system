<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')
    ->group(function () {
        Route::controller(AuthController::class)
            ->name('auth')
            ->group(function () {
                Route::get(
                    'user',
                    fn (Request $request) => new UserResource($request->user())
                );
                Route::post('login', 'login')->withoutMiddleware('auth:api');
                Route::post('register', 'register')->withoutMiddleware('auth:api');
                Route::post('logout', 'logout');
                Route::post('refresh', 'refresh');
            });

        Route::controller(AddressController::class)
            ->name('addresses')
            ->prefix('addresses')
            ->group(function () {
                Route::post('', 'store');
                Route::put('{address}', 'update');
                Route::delete('{address}', 'destroy');
            });

        Route::controller(ProjectController::class)
            ->prefix('projects')
            ->group(function () {
                Route::get('', 'index');
                Route::post('', 'store');
                Route::get('{project}', 'show');
                Route::put('{project}', 'update');
                Route::delete('{project}', 'destroy');
            });

        Route::controller(TaskController::class)
            ->prefix('tasks')
            ->group(function () {
                Route::get('', 'index');
                Route::post('', 'store');
                Route::get('{task}', 'show');
                Route::put('{task}', 'update');
                Route::delete('{task}', 'destroy');
            });
    });
