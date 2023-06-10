<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\SatuanBesarController;
use App\Http\Controllers\Master\SatuanKecilController;
use App\Http\Controllers\Master\SuplierController;
use App\Http\Controllers\Master\TelurController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\TelurStokController;
use App\Http\Controllers\Transaksi\KeluarController;
use App\Http\Controllers\Transaksi\KeluarDetailController;
use App\Http\Controllers\Transaksi\MasukController;
use App\Http\Controllers\Transaksi\MasukDetailController;
use App\Http\Controllers\Transaksi\ReturController;
use App\Http\Controllers\Transaksi\ReturDetailController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'showLoginForm']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'master-data', 'as' => 'master-data.', 'middleware' => 'admin'], function () {
        Route::resources([
            'user' => UserController::class,
            'satuan-besar' => SatuanBesarController::class,
            'satuan-kecil' => SatuanKecilController::class,
            'suplier' => SuplierController::class,
            'telur' => TelurController::class
        ], [
            'except' => ['show']
        ]);
    });

    Route::get('stok-telur', [TelurStokController::class, 'index'])->name('stok.index');

    Route::group(['prefix' => 'transaksi', 'as' => 'transaksi.'], function () {
        Route::resource('masuk', MasukController::class);
        Route::resource('masuk.detail', MasukDetailController::class)->only(['store', 'destroy']);
        Route::post('masuk/{masuk}/insert-stok', [MasukController::class, 'insertStok'])->name('masuk.insert-stok');

        Route::resource('keluar', KeluarController::class);
        Route::resource('keluar.detail', KeluarDetailController::class)->only(['store',  'destroy']);
        Route::post('keluar/{keluar}/selesai', [KeluarController::class, 'selesai'])->name('keluar.selesai');
        Route::get('keluar/{keluar}/print', [KeluarController::class, 'cetak'])->name('keluar.print');

        Route::resource('retur', ReturController::class);
        Route::resource('retur.detail', ReturDetailController::class)->only(['store',  'destroy']);
        Route::post('retur/{retur}/selesai', [ReturController::class, 'selesai'])->name('retur.selesai');
    });
});
