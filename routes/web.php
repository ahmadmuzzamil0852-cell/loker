<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| ROUTE PUBLIK
|--------------------------------------------------------------------------
*/

// HOME
Route::get(
    '/',
    [ProductController::class, 'home']
)->name('home');

// KATALOG PRODUK
Route::get(
    '/produk',
    [ProductController::class, 'index']
)->name('produk.index');

// DETAIL PRODUK
Route::get(
    '/produk/{id}',
    [ProductController::class, 'show']
)->name('produk.show');

/*
|--------------------------------------------------------------------------
| LOGIN USER
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [AuthController::class, 'formLogin']
)->name('login');

Route::post(
    '/login',
    [AuthController::class, 'login']
)->name('login.user');

/*
|--------------------------------------------------------------------------
| REGISTER USER
|--------------------------------------------------------------------------
*/

Route::get(
    '/register',
    [AuthController::class, 'formRegister']
)->name('register');

Route::post(
    '/register',
    [AuthController::class, 'register']
)->name('register.proses');

/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/

Route::get(
    '/admin/login',
    [AuthController::class, 'formLoginAdmin']
)->name('login.admin');

Route::post(
    '/admin/login',
    [AuthController::class, 'loginAdmin']
)->name('login.admin.proses');

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->name('logout');

/*
|--------------------------------------------------------------------------
| ROUTE KHUSUS USER
|--------------------------------------------------------------------------
*/

Route::middleware('user')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | BELI PRODUK
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/beli',
        [TransaksiController::class, 'beli']
    )->name('beli');

    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI USER
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/transaksi',
        [TransaksiController::class, 'transaksi']
    )->name('transaksi');

    /*
    |--------------------------------------------------------------------------
    | PEMBAYARAN QRIS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/transaksi/qris/{index}',
        [TransaksiController::class, 'qris']
    )->name('transaksi.qris');

    Route::post(
        '/transaksi/qris/bayar',
        [TransaksiController::class, 'bayarQris']
    )->name('transaksi.qris.bayar');

    /*
    |--------------------------------------------------------------------------
    | UPLOAD BUKTI
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/upload-bukti',
        [TransaksiController::class, 'upload']
    )->name('upload.bukti');

    /*
    |--------------------------------------------------------------------------
    | NEGO USER
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/nego/respon',
        [TransaksiController::class, 'ajukanNego']
    )->name('nego.respon');

    Route::get(
        '/nego/beli/{id}',
        [TransaksiController::class, 'beliNego']
    )->name('nego.beli');
});

/*
|--------------------------------------------------------------------------
| CETAK STRUK
|--------------------------------------------------------------------------
*/

Route::get(
    '/transaksi/struk/{index}',
    [TransaksiController::class, 'cetakStruk']
)->name('transaksi.struk');

/*
|--------------------------------------------------------------------------
| ROUTE KHUSUS ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | KELOLA PRODUK
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/produk',
        [ProductController::class, 'admin']
    )->name('admin.produk');

    Route::get(
        '/admin/produk/tambah',
        [ProductController::class, 'formTambah']
    )->name('admin.produk.tambah');

    Route::post(
        '/admin/produk',
        [ProductController::class, 'simpan']
    )->name('admin.produk.simpan');

    Route::get(
        '/admin/produk/{id}/edit',
        [ProductController::class, 'edit']
    )->name('admin.produk.edit');

    Route::put(
        '/admin/produk/{id}',
        [ProductController::class, 'update']
    )->name('admin.produk.update');

    Route::delete(
        '/admin/produk/{id}',
        [ProductController::class, 'hapus']
    )->name('admin.produk.hapus');

    /*
    |--------------------------------------------------------------------------
    | KELOLA NEGO
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/nego',
        [TransaksiController::class, 'list']
    )->name('nego.index');

    Route::post(
        '/nego/admin/respon',
        [TransaksiController::class, 'responNego']
    )->name('nego.admin.respon');

    /*
    |--------------------------------------------------------------------------
    | DATA TRANSAKSI ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/transaksi',
        [TransaksiController::class, 'adminTransaksi']
    )->name('admin.transaksi');

    Route::post(
        '/nego/verifikasi',
        [TransaksiController::class, 'verifikasi']
    )->name('nego.verifikasi');

    /*
    |--------------------------------------------------------------------------
    | LAPORAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/laporan',
        [LaporanController::class, 'index']
    )->name('admin.laporan');

    Route::get(
        '/admin/laporan/pdf',
        [LaporanController::class, 'pdf']
    )->name('admin.laporan.pdf');

    Route::get(
        '/admin/laporan/excel',
        [LaporanController::class, 'excel']
    )->name('admin.laporan.excel');
});