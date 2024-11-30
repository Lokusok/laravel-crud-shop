<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index');
    Route::get('/cart/current', 'cart');
    Route::delete('/cart/current/{id}', 'destroy');
});

Route::middleware(['web'])->controller(MessageController::class)->group(function () {
    Route::get('/community/messages', 'index')->name('messages.index');
    Route::post('/community/messages', 'store')->name('messages.store');
    Route::delete('/community/messages/{message}', 'destroy')->name('messages.destroy');
});
