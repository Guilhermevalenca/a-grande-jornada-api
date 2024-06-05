<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')
    ->controller(ProfileController::class)
    ->middleware('auth:sanctum')
    ->whereNumber('user')
    ->group(function() {

        Route::patch('name', 'update_name');
        Route::patch('email', 'update_email');
        Route::patch('password', 'update_password');

    });
