<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KomiteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PekerjaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
   // Dashboard
   Route::get('/', [DashboardController::class, 'baseURL']);
   Route::get('/dashboard', [DashboardController::class, 'index']);
   Route::post('/chart-data', [DashboardController::class, 'getChartData']);
   Route::get('/chart-view', [DashboardController::class, 'getChartView']);

   // User
   Route::get('/profile', [UserController::class, 'index']);

   // Admin
   Route::middleware('admin')->group(function () {
      // User Control
      Route::resource('/pengguna', AdminUserController::class)->except(['show', 'edit', 'update', 'destroy']);
      Route::post('/pengguna-get-pegawai', [AdminUserController::class, 'getPegawai'])->name('pengguna.pegawai');
      Route::get('/pengguna/{user}', [AdminUserController::class, 'show'])->name('pengguna.show');
      Route::get('/pengguna/{user}/edit', [AdminUserController::class, 'edit'])->name('pengguna.edit');
      Route::put('/pengguna/{user}', [AdminUserController::class, 'update'])->name('pengguna.update');
      Route::delete('/pengguna/{user}', [AdminUserController::class, 'destroy'])->name('pengguna.delete');
      Route::post('/is-admin', [AdminUserController::class, 'isAdmin'])->name('is.admin');

      // Kepala Sekolah
      Route::get('/kepala-sekolah', [PekerjaController::class, 'showKepsek'])->name('pekerja.kepsek.detail');
      Route::get('/kepala-sekolah-edit', [PekerjaController::class, 'editKepsek'])->name('pekerja.kepsek.edit');

      // Tahun Ajaran
      Route::resource('/tahun-ajaran', TahunAjaranController::class);
      Route::post('/tahun-ajaran-get-data-form', [TahunAjaranController::class, 'getDataForm'])->name('tahun-ajaran.get-data-form');
      Route::post('/tahun-ajaran-get-siswa-option', [TahunAjaranController::class, 'getSiswaOption'])->name('thaun-ajaran.get-siswa-option');
   });

   // Guru
   Route::middleware(['guru'])->group(function () {
      // Kelas
      Route::resource('/kelas', KelasController::class);

      // Siswa
      Route::resource('/siswa', SiswaController::class);
      Route::post('/siswa-impor', [SiswaController::class, 'import'])->name('siswa.impor');
      Route::get('/siswa-format-download', [SiswaController::class, 'downloadFormat'])->name('siswa.download.format');

      // Prestasi
      Route::resource('/prestasi', PrestasiController::class);
      Route::post('/prestasi-impor', [PrestasiController::class, 'import'])->name('prestasi.impor');
   });

   Route::middleware(['tata_usaha'])->group(function () {
      // Pekerja
      Route::resource('/pekerja', PekerjaController::class);
      Route::get('/guru', [PekerjaController::class, 'indexGuru'])->name('pekerja.guru.index');
      Route::get('/tata-usaha', [PekerjaController::class, 'indexTu'])->name('pekerja.tata-usaha.index');
      Route::get('/staf-lain', [PekerjaController::class, 'indexLain'])->name('pekerja.staf-lain.index');
      Route::post('/pekerja-impor', [PekerjaController::class, 'import'])->name('pekerja.impor');

      // Surat Keluar
      Route::resource('/surat-keluar', SuratKeluarController::class);
      Route::get('/surat-keluar-new', [SuratKeluarController::class, 'createNewSurat'])->name('surat-keluar.new');
      Route::post('/surat-keluar-preview', [SuratKeluarController::class, 'suratPreview'])->name('surat-keluar.preview');
      Route::post('/surat-keluar-generate', [SuratKeluarController::class, 'generatePDF'])->name('surat-keluar.generate');

      // Surat Masuk
      Route::resource('/surat-masuk', SuratMasukController::class);

      // Komite
      Route::resource('/komite', KomiteController::class);
      Route::post('/komite-refresh', [KomiteController::class, 'refreshData'])->name('komite.refresh');
      Route::post('/komite-update', [KomiteController::class, 'updateKomite'])->name('komite.update');
      Route::post('/komite-data', [KomiteController::class, 'getDataKomite'])->name('komite.data');
      Route::get('/bebas-komite', [KomiteController::class, 'indexBebasKomite'])->name('komite.bebas-index');
      Route::post('/get-data-siswa', [KomiteController::class, 'getDataSiswa'])->name('komite.get-siswa');
      Route::put('/update-bebas-komite', [KomiteController::class, 'updateBebasKomite'])->name('komite.bebas-update');
      Route::post('/komite-export', [KomiteController::class, 'exportKomite'])->name('komite.export');
   });
});

// Login/logout
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');