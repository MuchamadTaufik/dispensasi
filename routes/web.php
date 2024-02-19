<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DispensasiController;
use App\Models\Dispensasi;

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
    })->middleware('auth');
    Route::get('/notifikasi', function () {
        return view('profile.notifikasi');
    })->middleware('auth');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/import-form', [ImportController::class, 'importForm'])->name('import.form');
    Route::post('/import', [ImportController::class, 'import'])->name('import');
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/users', [LoginController::class, 'ShowUserlist']);
    Route::get('/dispensasi',[DispensasiController::class, 'index']);
    Route::get('/pengajuan',[DispensasiController::class, 'create']);
    Route::post('/pengajuan',[DispensasiController::class, 'store']);
    Route::get('/dashboard-admin/approved/{id}',[DispensasiController::class, 'approved']);
    Route::get('/dashboard-admin/rejected/{id}',[DispensasiController::class, 'rejected']);

});

// Route::get('/change-password',[LoginController::class, 'changePassword'])->middleware('auth');
// Route::post('/change-password', [LoginController::class, 'processChangePassword']);