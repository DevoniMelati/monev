<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\OPDController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\InovasiController;
use App\Http\Controllers\Admin\JenisInovasiController;
use App\Http\Controllers\Admin\TipeLisensiInovasiController;
use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\Admin\UnitPengembangController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\RekapanController;
use App\Http\Controllers\Admin\LaporanController;
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

//Clear All:
Route::get('/clear', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('optimize');
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    return '<h1>Berhasil dibersihkan</h1>';
});

Route::get('/', function () {
    return view('home');
});

// Authentication
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/keluar', [HomeController::class, 'keluar']);
Route::get('/admin/home', [HomeController::class, 'index']);
Route::get('/admin/home/filter/{id}', [HomeController::class, 'index_filter']);
Route::get('/admin/change', [HomeController::class, 'change']);
Route::post('/admin/change_password', [HomeController::class, 'change_password']);

// OPD
Route::prefix('admin/opd')
    ->name('admin.opd.')
    ->middleware('cekLevel:1 2 3')
    ->controller(OPDController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

// Account
Route::prefix('admin/account')
    ->name('admin.account.')
    ->middleware('cekLevel:1 2 3')
    ->controller(AccountController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::get('/reset/{id}', 'reset')->name('reset');
    });

// Inovasi
Route::prefix('admin/inovasi')
    ->name('admin.inovasi.')
    ->middleware('cekLevel:1 2 3')
    ->controller(InovasiController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

// Jenis Inovasi
Route::prefix('admin/jenis_inovasi')
    ->name('admin.jenis_inovasi.')
    ->middleware('cekLevel:1 2 3')
    ->controller(JenisInovasiController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    // Tipe Lisensi Inovasi
Route::prefix('admin/tipe_lisensi_inovasi')
    ->name('admin.tipe_lisensi_inovasi.')
    ->middleware('cekLevel:1 2 3')
    ->controller(TipeLisensiInovasiController::class)
    ->group(function () {
    Route::get('/', 'read')->name('read');
    Route::get('/add', 'add')->name('add');
    Route::post('/create', 'create')->name('create');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
});
    // Dokumen
Route::prefix('admin/dokumen')
    ->name('admin.dokumen.')
    ->middleware('cekLevel:1 2 3')
    ->controller(DokumenController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create'); 
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
});
    // Unit Pengembang
Route::prefix('admin/unit_pengembang')
    ->name('admin.unit_pengembang.')
    ->middleware('cekLevel:1 2 3')
    ->controller(UnitPengembangController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create'); 
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
});
// Monitoring
Route::put('/admin/inovasi/status-toggle/{id}', [InovasiController::class, 'statusToggle']);
Route::prefix('admin/monitoring')
    ->name('admin.monitoring.')
    ->middleware('cekLevel:1 2 3')
    ->controller(MonitoringController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create'); 
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
        
});

// Laporan
Route::prefix('admin/laporan')
    ->name('admin.laporan.')
    ->middleware('cekLevel:1 2 3')
    ->controller(LaporanController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::get('/cetak', 'cetak')->name('cetak');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });
