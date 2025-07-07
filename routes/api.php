<?php

use App\Models\Siswa;
use App\Models\Transaksi_SPP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('/request/sanctum', [AuthController::class, 'request_sanctum_token']);
    Route::post('/request/jwt', [AuthController::class, 'request_jwt_token']);
});

Route::middleware('cors')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/transaction', [AuthController::class, 'transaction']);
    Route::post('/cekToken', [AuthController::class, 'verify_requested_token']);
});


Route::post('/request/sanctum', [AuthController::class, 'request_sanctum_token']);
Route::post('/request/jwt', [AuthController::class, 'request_jwt_token']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/transaction', [AuthController::class, 'transaction']);
Route::post('/verifikasi-spp', [AuthController::class, 'verifikasi_SPP']);
