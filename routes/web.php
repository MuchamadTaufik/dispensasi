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

Route::group(['middleware'=>'auth'], function(){
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
    Route::get('/import-form', [ImportController::class, 'importForm'])->name('register.excel');
    Route::post('/import', [ImportController::class, 'import'])->name('import');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/users', [LoginController::class, 'ShowUserlist']);
    Route::get('/dispensasi',[DispensasiController::class, 'index']);
    Route::get('/pengajuan',[DispensasiController::class, 'create']);
    Route::post('/pengajuan',[DispensasiController::class, 'store']);
    Route::get('/dashboard-admin/approved/{id}',[DispensasiController::class, 'approved']);
    Route::get('/dashboard-admin/rejected/{id}',[DispensasiController::class, 'rejected']);
    Route::post('/dashboard-admin/rejected/{id}',[DispensasiController::class, 'rejected']);
    Route::get('/dashboard-admin/done/{id}',[DispensasiController::class, 'done']);
    Route::get('/dispensasi/{dispensasi}', [DispensasiController::class, 'show'])->name('dispensasi.show');
    Route::get('/dispensasi/detail/{dispensasi}', [DispensasiController::class, 'detail'])->name('dispensasi.detail');
    Route::delete('/dispensasi/delete/{dispensasi}', [DispensasiController::class, 'destroy'])->name('dispensasi.delete');
    Route::put('/dispensasi/update/{dispensasi}', [DispensasiController::class, 'update'])->name('dispensasi.update');
    Route::get('/dispensasi/edit/{dispensasi}', [DispensasiController::class, 'edit'])->name('dispensasi.edit');
    Route::get('/download-pdf/{dispensasi}', [DispensasiController::class, 'downloadPdf'])->name('download-pdf');

    Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
});


// Route::get('/change-password',[LoginController::class, 'changePassword'])->middleware('auth');
// Route::post('/change-password', [LoginController::class, 'processChangePassword']);