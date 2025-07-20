<?php

/**
 * Routes which is neccessary for the SSO server.
 */

use Illuminate\Support\Facades\Route;
use Zefy\LaravelSSO\Controllers\ServerController;

Route::middleware('api')
    ->prefix('api/sso')
    ->group(static function () {
        Route::post('login', [ServerController::class, 'login']);
        Route::post('logout', [ServerController::class, 'logout']);
        Route::get('attach', [ServerController::class, 'attach']);
        Route::get('userInfo', [ServerController::class, 'userInfo']);
    });
