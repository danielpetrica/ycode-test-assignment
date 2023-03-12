<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [\App\Http\Controllers\CheckoutController::class, 'index']);

Route::get('countries', [DataController::class, 'getCountries']);
Route::get('products', [DataController::class, 'getProducts']);
Route::post('order', [CheckoutController::class, 'postOrder']);
