<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ...

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::resource('users', UserController::class);

    Route::get('/reports/login-activity', [App\Http\Controllers\ReportController::class, 'loginActivity'])->name('reports.login_activity');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
