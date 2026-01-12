<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::get('/reports/login-activity', [App\Http\Controllers\ReportController::class, 'loginActivity'])->name('reports.login_activity');
    Route::get('/account', [App\Http\Controllers\AccountController::class, 'edit'])->name('account.edit');
    Route::put('/account', [App\Http\Controllers\AccountController::class, 'update'])->name('account.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', function () {
    $schoolInfo = \App\Models\SchoolInformation::first();
    $articles = \App\Models\Article::where('status', 'published')->latest()->take(6)->get();

    return view('landing', compact('schoolInfo', 'articles'));
})->name('landing');

Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

Route::get('/pendaftaran', [App\Http\Controllers\PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran', [App\Http\Controllers\PendaftaranController::class, 'store'])->name('pendaftaran.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/student/payment/{payment}/print', [App\Http\Controllers\Student\PaymentController::class, 'print'])->name('student.payment.print');
    Route::get('/student/payment/{payment}/success', [App\Http\Controllers\Student\PaymentController::class, 'success'])->name('student.payment.success');
    Route::delete('/student/payment/{payment}/cancel', [App\Http\Controllers\Student\PaymentController::class, 'cancel'])->name('student.payment.cancel');
    Route::resource('/student/payment', App\Http\Controllers\Student\PaymentController::class, ['as' => 'student']);

    Route::get('/student/formulir', [App\Http\Controllers\Student\FormulirController::class, 'edit'])->name('student.formulir.edit');
    Route::get('/student/formulir/print', [App\Http\Controllers\Student\FormulirController::class, 'print'])->name('student.formulir.print');
    Route::get('/student/parent-data', [App\Http\Controllers\Student\FormulirController::class, 'parentData'])->name('student.parent_data');
    Route::put('/student/formulir', [App\Http\Controllers\Student\FormulirController::class, 'update'])->name('student.formulir.update');

    Route::put('/student/formulir', [App\Http\Controllers\Student\FormulirController::class, 'update'])->name('student.formulir.update');

    // Shared routes for viewing suggestions
    Route::get('/my-suggestions', [App\Http\Controllers\MySuggestionController::class, 'index'])->name('my_suggestions.index');
    Route::get('/my-suggestions/{suggestion}', [App\Http\Controllers\MySuggestionController::class, 'show'])->name('my_suggestions.show');

    // Routes for Panitia PPDB
    Route::middleware(['role:panitia'])->prefix('panitia')->name('panitia.')->group(function () {
        Route::resource('jadwal', App\Http\Controllers\Panitia\JadwalPpdbController::class);
        Route::post('articles/upload', [App\Http\Controllers\Panitia\ArticleController::class, 'uploadEditorImage'])->name('articles.upload');
        Route::resource('articles', App\Http\Controllers\Panitia\ArticleController::class);
        Route::resource('spp', App\Http\Controllers\Panitia\SppInformationController::class);

        Route::get('pendaftaran', [App\Http\Controllers\Panitia\PendaftaranSiswaController::class, 'index'])->name('pendaftaran.index');
        Route::get('pendaftaran/export', [App\Http\Controllers\Panitia\PendaftaranSiswaController::class, 'export'])->name('pendaftaran.export');
        Route::get('pembayaran/export', [App\Http\Controllers\Panitia\PendaftaranSiswaController::class, 'exportPayments'])->name('pembayaran.export');
        Route::get('pendaftaran/{siswa}', [App\Http\Controllers\Panitia\PendaftaranSiswaController::class, 'show'])->name('pendaftaran.show');
        Route::post('pendaftaran/{siswa}/verify', [App\Http\Controllers\Panitia\PendaftaranSiswaController::class, 'verify'])->name('pendaftaran.verify');
        Route::post('pendaftaran/{siswa}/update-status-konfirmasi', [App\Http\Controllers\Panitia\PendaftaranSiswaController::class, 'updateStatusKonfirmasi'])->name('pendaftaran.update_status_konfirmasi');
        Route::delete('pendaftaran/bulk-delete', [App\Http\Controllers\Panitia\PendaftaranSiswaController::class, 'bulkDestroy'])->name('pendaftaran.bulk_delete');
        Route::delete('pendaftaran/{siswa}', [App\Http\Controllers\Panitia\PendaftaranSiswaController::class, 'destroy'])->name('pendaftaran.destroy');
        Route::resource('users', App\Http\Controllers\Panitia\PanitiaUserController::class);
    });

    // Routes for Bendahara
    Route::middleware(['role:bendahara'])->prefix('bendahara')->name('bendahara.')->group(function () {
        Route::get('pembayaran', [App\Http\Controllers\Bendahara\PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('pembayaran/export', [App\Http\Controllers\Bendahara\PembayaranController::class, 'export'])->name('pembayaran.export');
        Route::get('pembayaran/{payment}', [App\Http\Controllers\Bendahara\PembayaranController::class, 'show'])->name('pembayaran.show');
        Route::put('pembayaran/{payment}', [App\Http\Controllers\Bendahara\PembayaranController::class, 'update'])->name('pembayaran.update'); // Optional if needed
        Route::delete('pembayaran/bulk-delete', [App\Http\Controllers\Bendahara\PembayaranController::class, 'bulkDestroy'])->name('pembayaran.bulk_delete');
        Route::delete('pembayaran/{payment}', [App\Http\Controllers\Bendahara\PembayaranController::class, 'destroy'])->name('pembayaran.destroy');

        Route::get('laporan', [App\Http\Controllers\Bendahara\LaporanController::class, 'index'])->name('laporan.index');
    });

    // Routes for Kepala Sekolah
    Route::middleware(['role:kepala_sekolah'])->prefix('kepala-sekolah')->name('kepala_sekolah.')->group(function () {
        Route::get('dashboard', [App\Http\Controllers\KepalaSekolah\KepalaSekolahController::class, 'index'])->name('dashboard');
        Route::get('laporan-ppdb', [App\Http\Controllers\KepalaSekolah\LaporanPpdbController::class, 'index'])->name('laporan_ppdb.index');
        Route::get('laporan-ppdb/export', [App\Http\Controllers\KepalaSekolah\LaporanPpdbController::class, 'export'])->name('laporan_ppdb.export');

        Route::get('laporan-keuangan', [App\Http\Controllers\KepalaSekolah\LaporanKeuanganController::class, 'index'])->name('laporan_keuangan.index');
        Route::get('laporan-keuangan/export', [App\Http\Controllers\KepalaSekolah\LaporanKeuanganController::class, 'export'])->name('laporan_keuangan.export');

        Route::resource('suggestions', App\Http\Controllers\KepalaSekolah\SuggestionController::class);
    });
});

Route::post('/payment/notification', [App\Http\Controllers\Student\PaymentController::class, 'notification'])->name('payment.notification');



Route::get('/test-notification/{id}', function ($id) {
    $payment = \App\Models\Payment::findOrFail($id);
    $payment->update(['status' => 'paid']);

    return 'Payment ' . $payment->id . ' status updated to paid';
});

Route::middleware(['auth', 'role:panitia'])->group(function () {
    Route::get('/panitia/school-information', [App\Http\Controllers\Panitia\SchoolInformationController::class, 'edit'])->name('panitia.school_information.edit');
    Route::put('/panitia/school-information', [App\Http\Controllers\Panitia\SchoolInformationController::class, 'update'])->name('panitia.school_information.update');
});
