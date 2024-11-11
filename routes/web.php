<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


//rute untuk semua role
Route::group(['middleware' => 'auth'], function () {
	Route::get(uri: '/home', action: [HomeController::class,'index'])->name('home');
    Route::get('register', [UserController::class,'register'])->name('register');
    Route::post('createUser', [UserController::class,'create'])->name('create');
    Route::get('user.index', [UserController::class,'index'])->name('user.index');
    Route::resource('user', UserController::class,['except'=>'show']);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

// rute khusus admin
Route::middleware(['auth','user-access:Admin'])->group(function(){
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

// // rute khusus guru
// Route::middleware(['auth','user-access:Guru'])->group(function(){
// });

// // rute khusus Tata_Usaha
// Route::middleware(['auth','user-access:Tata_Usaha'])->group(function(){
// });

// // rute Calon Siswa
// Route::middleware(['auth','user-access:Calon_Siswa'])->group(function(){
// });


