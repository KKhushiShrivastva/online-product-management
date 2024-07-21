<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/manage-product', [ProductController::class, 'manageProduct'])->name('manage-product');


//  API endpoint
Route::get('/products', [ProductController::class, 'getProducts']);
Route::get('/products/{id}', [ProductController::class, 'show']);

Route::post('/products', [ProductController::class, 'store']);

Route::post('/products/{id}', [ProductController::class, 'update']);


Route::delete('/products/{id}', [ProductController::class, 'deleteProduct']);
