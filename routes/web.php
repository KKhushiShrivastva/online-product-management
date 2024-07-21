<?php

use App\Models\User;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;

// Route::get('/', [FrontendController::class, 'index'])->name('profile.edit');
Route::get('/',  function () {
    return redirect('/manage-product');
});

Route::get('/dashboard', function () {
    $user_count = User::count();
    $prod_count = Product::count();
    $prod_in_stock_count = Product::where('stock', '>' ,1)->count();
    Log::info($user_count);
    Log::info($prod_count);

    return Inertia::render('Dashboard', [
        'userCount' => $user_count,
        'prodCount' => $prod_count,
        'prod_in_stock_count' => $prod_in_stock_count,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   

Route::get('/manage-product', [ProductController::class, 'manageProduct'])->name('manage-product');

Route::get('/products/create', [ProductController::class, 'createProduct'])->name('create-product');

Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('edit-product');
    
Route::get('/products/{id}', [ProductController::class, 'show'])->name('show-product');

});

require __DIR__.'/auth.php';
