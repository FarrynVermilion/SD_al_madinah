<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

//note kalo mau taru di guru atai tata usaha tolong taro di admin juga copas aja

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//rute untuk semua role
Route::group(['middleware' => 'auth'], function () {
	Route::get(uri: '/home', action: [HomeController::class,'index'])->name('home');
	Route::get('profile', [ProfileController::class,'edit'])->name('profile.edit');
	Route::put('profile', [ProfileController::class,'update'])->name('profile.update');
	Route::put('profile/password', [ProfileController::class,'password'])->name('profile.password');
});

// rute khusus guru
Route::middleware(['auth','user-access:Guru'])->group(callback: function(){
    Route::get(uri: '/pelanggaran/home', action: [HomeController::class,'indexPelanggaran'])->name(name: 'homePelanggaran');
    Route::get(uri: '/absensi/home', action: [HomeController::class,'indexAbsensi'])->name(name: 'homeAbsensi');
});

// rute khusus Tata_Usaha
Route::middleware(['auth','user-access:Tata_Usaha'])->group(callback: function(){
    Route::get(uri: '/pendaftaran/home', action: [HomeController::class,'indexPendaftaran'])->name(name: 'homePendaftaran');
    Route::get(uri: '/SPP/home', action: [HomeController::class,'indexSPP'])->name(name: 'homeSPP');
});

// // rute Calon Siswa
// Route::middleware(['auth','user-access:Calon_Siswa'])->group(function(){
// });

// rute khusus admin
Route::middleware(['auth','user-access:Admin'])->group(function(){
    Route::get('register', [UserController::class,'register'])->name('register');
    Route::post('createUser', [UserController::class,'create'])->name('create');
    Route::get('user.index', [UserController::class,'index'])->name('user.index');
    Route::resource('user', UserController::class);

    Route::get(uri: '/pendaftaran/home', action: [HomeController::class,'indexPendaftaran'])->name(name: 'homePendaftaran');
    Route::get(uri: '/SPP/home', action: [HomeController::class,'indexSPP'])->name(name: 'homeSPP');
    Route::get(uri: '/pelanggaran/home', action: [HomeController::class,'indexPelanggaran'])->name(name: 'homePelanggaran');
    Route::get(uri: '/absensi/home', action: [HomeController::class,'indexAbsensi'])->name(name: 'homeAbsensi');

    Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});




