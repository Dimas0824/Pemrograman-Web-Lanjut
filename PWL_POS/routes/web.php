<?php

use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter id, maka harus berupa angka

// Routes for login (auth.login)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () { //login dulu sebelum akses route dibawah
    // Routes for dashboard (welcome.blade.php)
    Route::get('/', [WelcomeController::class, 'index']);

    // Routes for User
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/list', [UserController::class, 'list']);
        Route::get('/create', [UserController::class, 'create']);
        Route::post('/', [UserController::class, 'store']); // Menambahkan rute POST
        Route::get('/create_ajax', [UserController::class, 'create_ajax']);
        Route::post('/ajax', [UserController::class, 'store_ajax']);
        Route::get('/{id}/show', [UserController::class, 'show']);
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
    });

    // Routes for Level
    Route::group(['prefix' => 'level'], function () {
        Route::get('/', [LevelController::class, 'index']);
        Route::get('/list', [LevelController::class, 'list']);
        Route::get('/create', [LevelController::class, 'create']);
        Route::post('/', [LevelController::class, 'store']); // Menambahkan rute POST
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
        Route::post('/ajax', [LevelController::class, 'store_ajax']);
        Route::get('/{id}/show', [LevelController::class, 'show']);
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
    });

    // Routes for Kategori
    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']);
        Route::get('/list', [KategoriController::class, 'list']);
        Route::get('/create', [KategoriController::class, 'create']);
        Route::post('/', [KategoriController::class, 'store']); // Sudah ada
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);
        Route::post('/ajax', [KategoriController::class, 'store_ajax'])->withoutMiddleware('auth');
        Route::get('/{id}/show', [KategoriController::class, 'show']);
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
    });

    // Routes for Suplier
    Route::group(['prefix' => 'suplier'], function () {
        Route::get('/', [SuplierController::class, 'index']);
        Route::get('/list', [SuplierController::class, 'list']);
        Route::get('/create', [SuplierController::class, 'create']);
        Route::post('/', [SuplierController::class, 'store']); // Menambahkan rute POST
        Route::get('/create_ajax', [SuplierController::class, 'create_ajax']);
        Route::post('/ajax', [SuplierController::class, 'store_ajax']);
        Route::get('/{id}/show', [SuplierController::class, 'show']);
        Route::get('/{id}/edit_ajax', [SuplierController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [SuplierController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [SuplierController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [SuplierController::class, 'delete_ajax']);
    });

    // Routes for Barang
    Route::group(['prefix' => 'barang'], function () {
        Route::get('/', [BarangController::class, 'index']);
        Route::post('/list', [BarangController::class, 'list']);
        Route::get('/create', [BarangController::class, 'create']);
        Route::post('/', [BarangController::class, 'store']); // Menambahkan rute POST
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
        Route::post('/ajax', [BarangController::class, 'store_ajax'])->name('barang.store_ajax');
        Route::get('/{id}/show', [BarangController::class, 'show']);
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
    });

});
