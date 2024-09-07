<?php

use Illuminate\Support\Facades\Route;
use AppAuth\Google\Http\Controllers\GoogleAuthController;

Route::group(['middleware' => ['web']], function () {
    Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle']);
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
});
