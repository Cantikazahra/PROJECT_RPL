<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// JALUR HALAMAN AWAL (WELCOME / LANDING PAGE)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// JALUR OTENTIKASI (GUEST - BELUM LOGIN)
Route::middleware(['guest'])->group(function () {
    // Tampilan & Proses Login biasa
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login/proses', [AuthController::class, 'loginProcess'])->name('login.process');

    // Rute Simulasi Login Cepat via Google
    Route::get('/auth/google/redirect', [AuthController::class, 'loginGoogleMock'])->name('login.google.mock');

    // Tampilan & Proses Registrasi
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register/proses', [AuthController::class, 'registerProcess'])->name('register.process');
});

// JALUR LOGOUT (HARUS LOGIN DULU)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// JALUR USER PEMOHON (HARUS LOGIN)
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Utama User
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    
    // Form Input Pengajuan Izin
    Route::get('/pengajuan', [UserController::class, 'showPengajuan'])->name('user.pengajuan');
    Route::post('/pengajuan/proses', [UserController::class, 'processPengajuan'])->name('user.pengajuan.process');
    
    // Form Upload Dokumen Pendukung
    Route::get('/pengajuan/upload/{id}', [UserController::class, 'showUpload'])->name('user.upload');
    Route::post('/pengajuan/upload/proses/{id}', [UserController::class, 'processUpload'])->name('user.upload.process');

    // Halaman Detail Pengajuan
    Route::get('/pengajuan/detail/{id}', [UserController::class, 'detailPengajuan'])->name('user.pengajuan.detail');

    // KUMPULAN ROUTE SIDEBAR
    Route::get('/status-pengajuan', [UserController::class, 'statusPengajuan'])->name('user.status');
    Route::get('/riwayat-permohonan', [UserController::class, 'riwayatPengajuan'])->name('user.riwayat');
    
    Route::get('/dokumen-saya', [UserController::class, 'dashboard'])->name('user.dokumen');
    Route::get('/notifikasi', [UserController::class, 'dashboard'])->name('user.notifikasi');
    Route::get('/panduan', [UserController::class, 'dashboard'])->name('user.panduan');
    Route::get('/bantuan', [UserController::class, 'dashboard'])->name('user.bantuan');
});