<?php

use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);

// Routes for User
Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);           // Show user dashboard
    Route::get('/list', [UserController::class, 'list']);        // Show user data in JSON for DataTables
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Show add user form via AJAX
    Route::post('/ajax', [UserController::class, 'store_ajax']); // Store new user via AJAX
    Route::post('/{id}', [UserController::class, 'show']);       // Show user details
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Show edit user form via AJAX
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Update user via AJAX
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Confirm delete user via AJAX
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Delete user via AJAX
});

// Routes for Level
Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']);           // Show user dashboard
    Route::get('/list', [LevelController::class, 'list']);
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
    Route::post('/ajax', [LevelController::class, 'store_ajax']);
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
});

// Routes for Kategori
Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']);           // Show user dashboard
    Route::get('/list', [KategoriController::class, 'list']);
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);
    Route::post('/ajax', [KategoriController::class, 'store_ajax']);
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
});

// Routes for Suplier
Route::group(['prefix' => 'suplier'], function () {
    Route::get('/', [SuplierController::class, 'index']);           // Show user dashboard
    Route::get('/list', [SuplierController::class, 'list']);
    Route::get('/create_ajax', [SuplierController::class, 'create_ajax']);
    Route::post('/ajax', [SuplierController::class, 'store_ajax']);
    Route::get('/{id}/edit_ajax', [SuplierController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [SuplierController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [SuplierController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [SuplierController::class, 'delete_ajax']);
});

// Routes for Barang
Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']);           // Show user dashboard
    Route::get('/list', [BarangController::class, 'list']);
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
    Route::post('/ajax', [BarangController::class, 'store_ajax']);
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
});
