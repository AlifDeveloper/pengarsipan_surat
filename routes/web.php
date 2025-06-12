<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\KlasifikasiArsipController;
use App\Http\Controllers\laporan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'verify'])->name('auth.verify');

Route::group(['middleware' => 'auth:petugas'], function(){

    Route::resource('klasifikasi-arsip', KlasifikasiArsipController::class);
    Route::resource('surat-masuk', SuratMasukController::class)->except('destroy');
    Route::delete('/surat-masuk/{id}', [SuratMasukController::class, 'destroy'])->name('suratmasuk.delete');
    Route::resource('surat-keluar', SuratKeluarController::class);
    Route::resource('disposisi', DisposisiController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('laporan', laporan::class);
    Route::get('/laporan/cetak', [laporan::class, 'cetak'])->name('laporan.cetak');
    Route::post('/profile/upload', [ProfileController::class, 'upload'])->name('profile.upload');
    Route::get('/disposisi-cetak/{no_disposisi}', [DisposisiController::class, 'cetak'])->name('disposisi.cetak');
});


Route::group(['middleware' => 'auth:kades'], function(){
    Route::resource('pengarsipan-surat-masuk', SuratMasukController::class)->except('update', 'destroy', 'create', 'edit');
    Route::resource('pengarsipan-surat-keluar', SuratKeluarController::class)->except('update', 'destroy', 'create', 'edit');
    Route::resource('pengarsipan-disposisi', DisposisiController::class)->except('update', 'edit', 'create', 'destroy');
    Route::get('/pengarsipan-disposisi-cetak/{no_disposisi}', [DisposisiController::class, 'cetak'])->name('pengarsipan.disposisi.cetak');
    Route::resource('laporan-surat', laporan::class)->except('update', 'edit', 'create', 'destroy');
    Route::get('/laporan-surat/cetak', [laporan::class, 'cetak'])->name('laporan.surat.cetak');
    Route::resource('profile-info', ProfileController::class);
    Route::post('/profile-info/upload', [ProfileController::class, 'upload'])->name('profile.kades.upload');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
