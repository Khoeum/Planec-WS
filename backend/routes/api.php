<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ── Orders ──
Route::post('/orders', [OrderController::class, 'store']);

// ── Contact (if you have it) ──
// Route::post('/contact', [ContactController::class, 'store']);

// ── Products (if you have it) ──
// Route::get('/products', [ProductController::class, 'index']);



