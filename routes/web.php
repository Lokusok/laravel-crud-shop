<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\LangMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('/{locale?}')->middleware(LangMiddleware::class)->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'loginize'])->name('auth.loginize');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::post('/lang', [LangController::class, 'switch'])->name('lang.switch');
});
