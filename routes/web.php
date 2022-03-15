<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PekerjaController;
use App\Http\Controllers\SiswaController;
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
Route::get('/', [DashboardController::class, 'index']);

// Kelas
Route::resource('kelas', KelasController::class);

// Siswa
Route::resource('siswa', SiswaController::class);

// Pekerja
Route::resource('pekerja', PekerjaController::class);
Route::get('guru', [PekerjaController::class, 'index_guru']);
Route::get('tata-usaha', [PekerjaController::class, 'index_tu']);

// User
Route::get('/profile', [UserController::class, 'index']);