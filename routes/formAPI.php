<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::prefix('form')
    ->middleware('auth:sanctum')
    ->controller(FormController::class)
    ->whereNumber('form')
    ->group(function () {

        Route::get('', 'index');
        Route::post('', 'store');
        Route::delete('{form}', 'destroy');

    });

Route::prefix('form/question')
    ->middleware('auth:sanctum')
    ->controller(QuestionController::class)
    ->whereNumber('question')
    ->group(function () {

        Route::delete('{question}', 'destroy');

    });

Route::prefix('form/question/option')
    ->middleware('auth:sanctum')
    ->controller(OptionController::class)
    ->whereNumber('option')
    ->group(function () {

        Route::delete('{option}', 'destroy');

    });
