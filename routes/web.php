<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::get('/reports/login-activity', [App\Http\Controllers\ReportController::class, 'loginActivity'])->name('reports.login_activity');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/pendaftaran', [App\Http\Controllers\PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran', [App\Http\Controllers\PendaftaranController::class, 'store'])->name('pendaftaran.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
    Route::resource('/student/payment', App\Http\Controllers\Student\PaymentController::class, ['as' => 'student']);

    // Routes for Panitia PPDB
    Route::middleware(['role:panitia pddb'])->prefix('panitia')->name('panitia.')->group(function () {
        Route::resource('jadwal', App\Http\Controllers\Panitia\JadwalPpdbController::class);

        Route::get('pendaftaran', [App\Http\Controllers\Panitia\PendaftaranSiswaController::class, 'index'])->name('pendaftaran.index');
        Route::get('pendaftaran/{siswa}', [App\Http\Controllers\Panitia\PendaftaranSiswaController::class, 'show'])->name('pendaftaran.show');
        Route::post('pendaftaran/{siswa}/verify', [App\Http\Controllers\Panitia\PendaftaranSiswaController::class, 'verify'])->name('pendaftaran.verify');
    });

    // Routes for Bendahara
    Route::middleware(['role:bendahara'])->prefix('bendahara')->name('bendahara.')->group(function () {
        Route::get('pembayaran', [App\Http\Controllers\Bendahara\PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('pembayaran/{payment}', [App\Http\Controllers\Bendahara\PembayaranController::class, 'show'])->name('pembayaran.show');
        Route::put('pembayaran/{payment}', [App\Http\Controllers\Bendahara\PembayaranController::class, 'update'])->name('pembayaran.update'); // Optional if needed

        Route::get('laporan', [App\Http\Controllers\Bendahara\LaporanController::class, 'index'])->name('laporan.index');
    });
});



Route::post('/payment/notification', [App\Http\Controllers\Student\PaymentController::class, 'notification'])->name('payment.notification');
