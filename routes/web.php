<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PekerjaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\UserController;
use App\Models\Pekerja;
use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\Types\Resource_;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

// Kelas
Route::resource('/kelas', KelasController::class);

// Siswa
Route::resource('/siswa', SiswaController::class);

// Pekerja
Route::resource('/pekerja', PekerjaController::class);
Route::get('/guru', [PekerjaController::class, 'index_guru']);
Route::get('/tata-usaha', [PekerjaController::class, 'index_tu']);
Route::get('/staf-lain', [PekerjaController::class, 'index_lain']);

// Surat Keluar
Route::resource('/surat-keluar', SuratKeluarController::class);

// Surat Masuk
Route::resource('/surat-masuk', SuratMasukController::class);

// Prestasi
Route::resource('/prestasi', PrestasiController::class);

// User
Route::get('/profile', [UserController::class, 'index']);

// Admin
Route::resource('/pengguna', AdminUserController::class)->except(['show', 'edit', 'update', 'destroy']);
Route::get('/pengguna/{user}', [AdminUserController::class, 'show'])->name('pengguna.show');
Route::get('/pengguna/{user}/edit', [AdminUserController::class, 'edit'])->name('pengguna.edit');
Route::put('/pengguna/{user}', [AdminUserController::class, 'update'])->name('pengguna.update');
Route::delete('/pengguna/{user}', [AdminUserController::class, 'destroy'])->name('pengguna.delete');

// Login/logout
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');