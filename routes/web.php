<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', [ProductController::class, 'home'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| PRODUK
|--------------------------------------------------------------------------
*/

// HALAMAN KATALOG
Route::get('/produk', [ProductController::class, 'index'])
    ->name('produk.index');

// DETAIL PRODUK
Route::get('/produk/{id}', [ProductController::class, 'show'])
    ->name('produk.show');

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

// FORM LOGIN
Route::get('/login', [AuthController::class, 'formLogin'])
    ->name('login');

// PROSES LOGIN
Route::post('/login', [AuthController::class, 'login']);

// LOGOUT
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| TRANSAKSI USER
|--------------------------------------------------------------------------
*/

// BELI PRODUK
Route::post('/beli', [TransaksiController::class, 'beli'])
    ->name('beli');

// HALAMAN TRANSAKSI USER
Route::get('/transaksi', [TransaksiController::class, 'transaksi'])
    ->name('transaksi');

// UPLOAD BUKTI PEMBAYARAN
Route::post('/upload-bukti', [TransaksiController::class, 'upload'])
    ->name('upload.bukti');

/*
|--------------------------------------------------------------------------
| NEGO USER & ADMIN
|--------------------------------------------------------------------------
*/

// HALAMAN DATA NEGO ADMIN
Route::get('/nego', [TransaksiController::class, 'list'])
    ->name('nego.index');

// USER AJUKAN NEGO / ADMIN RESPON
Route::post('/nego/respon', [TransaksiController::class, 'respon'])
    ->name('nego.respon');

// ADMIN VERIFIKASI PEMBAYARAN
Route::post('/nego/verifikasi', [TransaksiController::class, 'verifikasi'])
    ->name('nego.verifikasi');

/*
|--------------------------------------------------------------------------
| ADMIN PRODUK
|--------------------------------------------------------------------------
*/

// HALAMAN KELOLA PRODUK
Route::get('/admin/produk', [ProductController::class, 'admin'])
    ->name('admin.produk');

// FORM TAMBAH PRODUK
Route::get('/admin/produk/tambah',
    [ProductController::class, 'formTambah']);

// SIMPAN PRODUK
Route::post('/admin/produk/simpan',
    [ProductController::class, 'simpan']);

// FORM EDIT PRODUK
Route::get('/edit/{id}',
    [ProductController::class, 'edit']);

// UPDATE PRODUK
Route::post('/update/{id}',
    [ProductController::class, 'update']);

// HAPUS PRODUK
Route::get('/admin/produk/hapus/{id}',
    [ProductController::class, 'hapus'])
    ->name('admin.produk.hapus');

/*
|--------------------------------------------------------------------------
| ADMIN TRANSAKSI
|--------------------------------------------------------------------------
*/

// HALAMAN DATA TRANSAKSI ADMIN
Route::get('/admin/transaksi',
    [TransaksiController::class, 'adminTransaksi'])
    ->name('admin.transaksi');