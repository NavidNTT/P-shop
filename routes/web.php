<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;


Route::get('/', [StoreController::class, 'index'])->name('home');


// صفحه جزئیات محصول
Route::get('/products', [StoreController::class, 'products'])->name('products.index');
Route::get('/products/{product:slug}', [StoreController::class, 'show'])->name('products.show');