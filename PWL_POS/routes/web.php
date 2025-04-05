<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter id, maka harus berupa angka

// Routes for login (auth.login)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postlogin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
// Menampilkan halaman register
Route::get('/register', function () {
    return view('auth.register');
})->name('register.form');

// Proses registrasi
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::middleware(['auth'])->group(function () { //login dulu sebelum akses route dibawah
    // Routes for dashboard (welcome.blade.php)
    Route::get('/', [WelcomeController::class, 'index']);

    // Routes for User
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/list', [UserController::class, 'list']);
        Route::post('/', [UserController::class, 'store']); // Menambahkan rute POST
        Route::get('/create_ajax', [UserController::class, 'create_ajax']);
        Route::post('/ajax', [UserController::class, 'store_ajax']);
        Route::get('/{id}/show', [UserController::class, 'show']);
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);

        // Menambahkan rute baru
        Route::get('/import', [UserController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [UserController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [UserController::class, 'export_excel']); // export excel
        Route::get('/export_pdf', [UserController::class, 'export_pdf']); // export pdf
    });

    // Routes untuk Level dengan middleware auth dan authorize
    Route::middleware(['auth', 'authorize:ADM,MNG'])->group(function () {
        Route::prefix('level')->group(function () {
            Route::get('/', [LevelController::class, 'index']);
            Route::get('/list', [LevelController::class, 'list']);
            Route::post('/', [LevelController::class, 'store']); // Menambahkan rute POST
            Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
            Route::post('/ajax', [LevelController::class, 'store_ajax']);
            Route::get('/{id}/show', [LevelController::class, 'show']);
            Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);

            // Menambahkan rute baru
            Route::get('/import', [LevelController::class, 'import']); // ajax form upload excel
            Route::post('/import_ajax', [LevelController::class, 'import_ajax']); // ajax import excel
            Route::get('/export_excel', [LevelController::class, 'export_excel']); // export excel
            Route::get('/export_pdf', [LevelController::class, 'export_pdf']); // export pdf
        });
    });

    // Routes for Kategori
    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']);
        Route::get('/list', [KategoriController::class, 'list']);
        Route::post('/', [KategoriController::class, 'store']); // Sudah ada
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);
        Route::post('/ajax', [KategoriController::class, 'store_ajax'])->withoutMiddleware('auth');
        Route::get('/{id}/show', [KategoriController::class, 'show']);
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);

        // Menambahkan rute baru
        Route::get('/import', [KategoriController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [KategoriController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [KategoriController::class, 'export_excel']); // export excel
        Route::get('/export_pdf', [KategoriController::class, 'export_pdf']); // export pdf
    });

    // Routes for Suplier
    Route::group(['prefix' => 'suplier'], function () {
        Route::get('/', [SuplierController::class, 'index']);
        Route::get('/list', [SuplierController::class, 'list']);
        Route::post('/', [SuplierController::class, 'store']); // Menambahkan rute POST
        Route::get('/create_ajax', [SuplierController::class, 'create_ajax']);
        Route::post('/ajax', [SuplierController::class, 'store_ajax']);
        Route::get('/{id}/show', [SuplierController::class, 'show']);
        Route::get('/{id}/edit_ajax', [SuplierController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [SuplierController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [SuplierController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [SuplierController::class, 'delete_ajax']);

        // Menambahkan rute baru
        Route::get('/import', [SuplierController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [SuplierController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [SuplierController::class, 'export_excel']); //  export excel
        Route::get('/export_pdf', [SuplierController::class, 'export_pdf']); // export pdf
    });

    // Routes for Barang
    Route::group(['prefix' => 'barang'], function () {
        Route::get('/', [BarangController::class, 'index']);
        Route::post('/list', [BarangController::class, 'list']);
        Route::post('/', action: [BarangController::class, 'store']); // Menambahkan rute POST
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
        Route::post('/ajax', [BarangController::class, 'store_ajax'])->name('barang.store_ajax');
        Route::get('/{id}/show', [BarangController::class, 'show']);
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);

        // Menambahkan rute baru
        Route::get('/import', [BarangController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [BarangController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [BarangController::class, 'export_excel']); // export excel
        Route::get('/export_pdf', [BarangController::class, 'export_pdf']); // export pdf
    });

});

