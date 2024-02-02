<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

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
// Route::get('/account', function () {
//     return view('super-admin.index');
// })->middleware('auth');

Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/import-form', [ImportController::class, 'importForm'])->name('import.form');
Route::post('/import', [ImportController::class, 'import'])->name('import');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');

Route::get('register', [RegisterController::class, 'create'])->middleware('auth')->name('register');
Route::post('register', [RegisterController::class, 'store'])->middleware('auth');

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');


Route::get('/users', function () {
    return view('dashboard-admin.users');
})->middleware('auth');

Route::get('/users', [LoginController::class, 'ShowUserlist'])->middleware('auth');

Route::get('/profile', function () {
    return view('profile.index');
})->middleware('auth');

// Route::get('/change-password',[LoginController::class, 'changePassword'])->middleware('auth');
// Route::post('/change-password', [LoginController::class, 'processChangePassword']);