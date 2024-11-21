<?php

use App\Http\Controllers\Api\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart/current', [CartController::class, 'cart']);
Route::delete('/cart/current/{id}', [CartController::class, 'destroy']);
