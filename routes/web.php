<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'index'])->name('articles.cart');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
