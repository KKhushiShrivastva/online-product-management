<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('profile.edit');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Products Routes of view inertia
    Route::get('/manage-product', [ProductController::class, 'manageProduct'])->name('manage-product');
    // Route::get('/products/{id}/edit', [ProductController::class, 'editProducts'])->name('edit-product');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    

    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
   

    //  API endpoint
    Route::get('/api/products', [ProductController::class, 'getProducts']); 
    Route::get('/api/products', [ProductController::class, 'getProducts']);
    Route::delete('/api/products/{id}', [ProductController::class, 'deleteProduct']);

    Route::post('/api/products', [ProductController::class, 'store']);
    Route::put('/api/products/{id}', [ProductController::class, 'update']);
    Route::get('/api/products/{id}', [ProductController::class, 'show']);

    Route::get('/products/create', [ProductController::class, 'createProduct'])->name('create-product');

});

require __DIR__.'/auth.php';
