<?php

use App\Models\Dispensasi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DispensasiController;
use App\Http\Controllers\NotifikasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::get('/dispensasi/data/{dispensasi}', [DispensasiController::class, 'data'])->name('dispensasi.data');

Route::group(['middleware'=>'auth'], function(){
    Route::get('/change-password',[LoginController::class, 'changePassword']);
    Route::post('/change-password', [LoginController::class, 'processChangePassword'])->name('change-password');
    Route::get('/profile', function () {
        return view('profile.index');
    });
    Route::get('/notifikasi', function () {
        return view('profile.notifikasi.index');
    });
    Route::get('/pesan', function () {
        return view('profile.pesan.index');
    });
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/pengajuan',[DispensasiController::class, 'create']);
    Route::post('/pengajuan',[DispensasiController::class, 'store']);
    Route::get('/download-pdf/{dispensasi}', [DispensasiController::class, 'downloadPdf'])->name('download-pdf');
    Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
    Route::get('/download-laporan-masuk', [DashboardController::class, 'laporanDispensasiMasuk'])->name('dashboard.download.laporan.masuk');
    Route::get('/download-laporan-keluar', [DashboardController::class, 'laporanDispensasiKeluar'])->name('dashboard.download.laporan.keluar');
});

Route::group(['middleware'=>'guru.piket'], function(){
    Route::get('/dispensasi',[DispensasiController::class, 'index']);
    Route::get('/dashboard-admin/approved/{id}',[DispensasiController::class, 'approved']);
    Route::get('/dashboard-admin/rejected/{id}',[DispensasiController::class, 'rejected']);
    Route::post('/dashboard-admin/rejected/{id}',[DispensasiController::class, 'rejected']);
    Route::get('/dashboard-admin/done/{id}',[DispensasiController::class, 'done']);
    Route::get('/dispensasi/{dispensasi}', [DispensasiController::class, 'show'])->name('dispensasi.show');
    Route::get('/dispensasi/detail/{dispensasi}', [DispensasiController::class, 'detail'])->name('dispensasi.detail');
    Route::delete('/dispensasi/delete/{dispensasi}', [DispensasiController::class, 'destroy'])->name('dispensasi.delete');
    Route::put('/dispensasi/update/{dispensasi}', [DispensasiController::class, 'update'])->name('dispensasi.update');
    Route::get('/dispensasi/edit/{dispensasi}', [DispensasiController::class, 'edit'])->name('dispensasi.edit');
});

Route::group(['middleware'=>'admin'], function(){
    Route::get('/import-form', [ImportController::class, 'importForm'])->name('register.excel');
    Route::post('/import', [ImportController::class, 'import'])->name('import');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/users', [LoginController::class, 'ShowUserlist']);
    Route::get('/users/edit/{user}', [RegisterController::class, 'edit'])->name('users.edit');
    Route::delete('/users/delete/{user}', [RegisterController::class, 'destroy'])->name('users.delete');
    Route::put('/users/update/{user}', [RegisterController::class, 'update'])->name('users.update');
});