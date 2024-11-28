<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\LangMiddleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/only-auth', function () {
    Gate::authorize('see-auth');

    return 'Only auth page';
});

Route::get('/only-auth/authorize', function () {
    Session::put('can_see', true);
    return 'Authorized';
});

Route::middleware(['auth'])->group(function () {
    Route::get('/email_verify/{token}', [UserController::class, 'verifyEmail'])->name('email.verify');
    Route::post('/email_verify', [UserController::class, 'verifyEmailAgain'])->name('email.verify.resend');
});

Route::prefix('/{locale?}')->middleware(LangMiddleware::class)->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

    Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/articles/{slug}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{slug}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{slug}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::match(['GET', 'POST'], '/cart/download', [CartController::class, 'download'])->name('cart.download');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::post('/lang', [LangController::class, 'switch'])->name('lang.switch');

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
        Route::post('/login', [AuthController::class, 'loginize'])->name('auth.loginize');

        Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
        Route::post('/register', [AuthController::class, 'registerize'])->name('auth.registerize');
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    });
});

Route::middleware(['guest'])->controller(OAuthController::class)->group(function () {
    Route::prefix('/oauth/github')->group(function () {
        Route::get('/redirect', 'githubRedirect')->name('oauth.github.redirect');
        Route::get('/callback', 'githubAuthenticate');
    });

    Route::prefix('/oauth/google')->group(function () {
        Route::get('/redirect', 'googleRedirect')->name('oauth.google.redirect');
        Route::get('/callback', 'googleAuthenticate');
    });
});
