<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login/proses', [AuthController::class, 'loginProcess'])->name('login.process');
    Route::get('/auth/google/redirect', [AuthController::class, 'loginGoogleMock'])->name('login.google.mock');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register/proses', [AuthController::class, 'registerProcess'])->name('register.process');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    
    Route::get('/pengajuan', [UserController::class, 'showPengajuan'])->name('user.pengajuan');
    Route::post('/pengajuan/proses', [UserController::class, 'processPengajuan'])->name('user.pengajuan.process');
    
    Route::get('/pengajuan/upload/{id}', [UserController::class, 'showUpload'])->name('user.upload');
    Route::post('/pengajuan/upload/proses/{id}', [UserController::class, 'processUpload'])->name('user.upload.process');

    Route::get('/dokumen/lihat/{id}/{field}', [UserController::class, 'lihatDokumen'])->name('user.dokumen.lihat');

    Route::get('/pengajuan/detail/{id}', [UserController::class, 'detailPengajuan'])->name('user.pengajuan.detail');

    Route::get('/status-pengajuan/{id}', [UserController::class, 'statusPengajuan'])->name('user.status');
    Route::get('/riwayat-permohonan', [UserController::class, 'riwayatPengajuan'])->name('user.riwayat');
    
    Route::get('/dokumen-saya', [UserController::class, 'dashboard'])->name('user.dokumen');
    Route::get('/notifikasi', [UserController::class, 'dashboard'])->name('user.notifikasi');
    Route::get('/panduan', [UserController::class, 'showPanduan'])->name('user.panduan');
    Route::get('/bantuan', [UserController::class, 'dashboard'])->name('user.bantuan');

    Route::get('/profil', [UserController::class, 'showProfil'])->name('user.profil');
    
    Route::get('/dokumen/lihat/{id}/{field}', [UserController::class, 'lihatDokumen'])->name('user.dokumen.lihat');
});