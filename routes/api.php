<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use Illuminate\Container\Attributes\Auth;
use App\Http\Middleware\Cors;



Route::group(['middleware' => ['cors']], function () {
    Route::post('/shit', function (Request $request) {
        return $request;
    })->name('shit');
    Route::post('/login', [AuthController::class, 'login'])->name('mlogin');
    Route::post('/register', [AuthController::class,'register'])->name('mregister');
    Route::middleware('auth:api')->group(function () {
        // our routes to be protected will go in here
        Route::post('/logout', [AuthController::class,'logout'])->name('mlogout');
    });
});
