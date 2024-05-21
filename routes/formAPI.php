<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::prefix('form')
    ->middleware('auth:sanctum')
    ->controller(FormController::class)
    ->whereNumber('form')
    ->group(function () {

        Route::post('', 'store');

    });
