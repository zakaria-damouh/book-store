<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

// Categories CRUD
Route::resource('categories', CategoryController::class);

// Products CRUD
Route::resource('products', ProductController::class);