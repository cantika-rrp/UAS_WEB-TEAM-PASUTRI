<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController; 
use App\Http\Controllers\RatingController; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sini adalah tempat mendaftarkan route API untuk aplikasi kamu.
| Semua route di dalam file ini otomatis memiliki awalan "/api".
|
*/

// ==========================================
// 1. JALUR PUBLIC (Bisa diakses tanpa login)
// ==========================================

// API untuk mengambil data katalog casing/produk
Route::apiResource('products', ProductController::class);

// API untuk registrasi akun baru dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
Route::post('/login', [AuthController::class, 'login']);


// ==========================================
// 2. JALUR PRIVATE (Wajib login / bawa token)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    
    // --- FITUR PROFIL & AUTH ---
    // Mengambil data user yang sedang login (untuk halaman View Profile)
    Route::get('/user', function (Request $request) { 
        return $request->user(); 
    });
    // Logout untuk menghapus token
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // --- FITUR KERANJANG (CART) ---
    Route::get('/cart', [CartController::class, 'index']);           // Ambil semua isi keranjang
    Route::post('/cart', [CartController::class, 'store']);          // Tambah barang (katalog/custom) ke keranjang
    Route::delete('/cart/{id}', [CartController::class, 'destroy']); // Hapus satu item dari keranjang
    
    // --- FITUR TRANSAKSI (ORDERS) ---
    Route::post('/checkout', [OrderController::class, 'checkout']);  // Proses memindahkan keranjang jadi pesanan
    Route::get('/orders/history', [OrderController::class, 'history']); // Ambil semua riwayat pesanan user
    
    // --- FITUR PENILAIAN (RATINGS) ---
    Route::post('/ratings', [RatingController::class, 'store']); // Tambahkan penilaian untuk produk
});