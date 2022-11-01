<?php

use App\Http\Controllers\ApiProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/products',[ApiProductController::class, 'index'])->name('index');
Route::get('/product/show/{product}',[ApiProductController::class, 'show'])->name('show');
Route::post('/product/store',[ApiProductController::class, 'store'])->name('product.store');
Route::put('/product/update/{id}',[ApiProductController::class, 'update'])->name('product.update');
Route::delete('/product/delete/{id}',[ApiProductController::class, 'delete'])->name('product.delete');
Route::get('/products/search',[ApiProductController::class, 'search'])->name('product.search');
