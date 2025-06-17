<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\nominalSPPController;
use App\Http\Controllers\potonganSPPController;
use App\Http\Controllers\SPPSiswaController;
use App\Http\Controllers\transaksiSPPController;
use App\Http\Controllers\WaliSiswaController;
use App\Http\Controllers\JabatanController;

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

//rute untuk semua role
Route::middleware(['auth','user-access:Guru|Admin|Tata_Usaha|Siswa'])->group(function () {
	Route::get('home',  [HomeController::class,'index'])->name('home');
	Route::get('profile', [ProfileController::class,'edit'])->name('profile.edit');
	Route::put('profile', [ProfileController::class,'update'])->name('profile.update');
	Route::put('profile/password', [ProfileController::class,'password'])->name('profile.password');
});

// rute khusus guru
Route::middleware(['auth','user-access:Guru|Admin'])->group( function(){
    Route::get( '/pelanggaran/home',  [HomeController::class,'indexPelanggaran'])->name( 'homePelanggaran');
    Route::get( '/absensi/home',  [HomeController::class,'indexAbsensi'])->name( 'homeAbsensi');
});

// rute khusus Tata_Usaha
Route::middleware(['auth','user-access:Tata_Usaha|Admin'])->group( function(){
    Route::get( '/pendaftaran/home', [HomeController::class,'indexPendaftaran'])->name( 'homePendaftaran');
    Route::resource('/pendaftaran/siswa', SiswaController::class);
    Route::resource('/pendaftaran/wali', WaliSiswaController::class);
    Route::get( '/SPP/home', [HomeController::class,'indexSPP'])->name( 'homeSPP');
    Route::resource('/spp/nominal', nominalSPPController::class);
    Route::resource('/spp/potongan',  potonganSPPController::class);
    Route::resource('/spp/SPPsiswa', SPPSiswaController::class);
    Route::resource('/spp/transaksi', transaksiSPPController::class);
    Route::get("spp/siswa/cari", [SPPSiswaController::class,'cari'])->name("spp.siswa.cari");
    Route::get("spp/SPPsiswa/create_spp/{siswa}", [SPPSiswaController::class,'create_spp'])->name("spp.SPPsiswa.createSPP");
    Route::get("spp/transakis/cari/", [transaksiSPPController::class,'cari'])->name("transaksi.cari");

});

// // rute Siswa
// Route::middleware(['auth','user-access:Siswa'])->group(function(){
// });


// rute khusus admin
Route::middleware(['auth','user-access:Admin'])->group(function(){
    Route::get('user/cari', [UserController::class,'cari'])->name('cariUser');
    Route::get("jabatan/Cari", [JabatanController::class,'search'])->name("jabatan_cari");
    Route::get('register', [UserController::class,'register'])->name('register');
    Route::post('createUser', [UserController::class,'create'])->name('create');
    Route::resource('user', UserController::class);
    Route::get('user/{user}/edit', [UserController::class,'edit'])->name('user_edit');
    Route::post('user/{user}/update', [UserController::class,'update'])->name('user_update');
    Route::get('user/{id}/passwordEdit', [UserController::class,'passwordEdit'])->name('user.passwordEdit');
    Route::resource("jabatan", JabatanController::class);
    Route::post("jabatan/{jabatan}", [JabatanController::class,'insert'])->name("jabatan_insert");
    Route::post("jabatan/transaksi_jabatan_sekolah/destroy", [JabatanController::class,'jabatan_pengajar_destroy'])->name("jabatan_pengajar_destroy");
    Route::post("jabatan/transaksi_jabatan_wali/destroy", [JabatanController::class,'jabatan_wali_destroy'])->name("jabatan_wali_destroy");
    Route::get("spp/SPPsiswa/delete/{SPPsiswa}", [SPPSiswaController::class,'hapus'])->name("spp.SPPsiswa.delete");
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});




