<?php
use App\Http\Controllers\{AuthController, DashboardController, ItemController, SaleController, StaffController};
use App\Http\Middleware\OwnerOnly;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing');
Route::get('/masuk', [AuthController::class, 'form'])->name('login');
Route::post('/masuk', [AuthController::class, 'login']);
Route::get('/daftar', [AuthController::class, 'registerForm']);
Route::post('/daftar', [AuthController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::post('/keluar', [AuthController::class, 'logout']);
    Route::get('/ringkasan', [DashboardController::class, 'index']);
    Route::get('/barang', [ItemController::class, 'index']);
    Route::get('/penjualan', [SaleController::class, 'index']);
    Route::post('/penjualan', [SaleController::class, 'store']);
    Route::delete('/penjualan/{sale}', [SaleController::class, 'destroy']);
    Route::get('/penjualan/ekspor', [SaleController::class, 'export']);

    Route::middleware(OwnerOnly::class)->group(function () {
        Route::post('/barang', [ItemController::class, 'store']);
        Route::get('/barang/{item}/ubah', [ItemController::class, 'edit']);
        Route::put('/barang/{item}', [ItemController::class, 'update']);
        Route::post('/barang/{item}/stok', [ItemController::class, 'restock']);
        Route::delete('/barang/{item}', [ItemController::class, 'destroy']);
        Route::get('/karyawan', [StaffController::class, 'index']);
        Route::post('/karyawan', [StaffController::class, 'store']);
        Route::delete('/karyawan/{id}', [StaffController::class, 'destroy']);
    });
});
