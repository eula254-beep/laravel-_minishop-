<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| Route Organization:
| 1. Public routes (Shop) - Accessible to everyone
| 2. Authenticated routes - Profile management (from Breeze)
| 3. Admin routes - Protected by auth and isAdmin middleware
|
*/

// ========================================
// PUBLIC SHOP ROUTES
// ========================================
// These routes are accessible to all users (guests and authenticated)
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/products/{product}', [ShopController::class, 'show'])->name('shop.show');

// ========================================
// AUTHENTICATED USER ROUTES (Laravel Breeze)
// ========================================
// Profile management routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========================================
// ADMIN ROUTES
// ========================================
// Protected routes for admin users only
// Uses 'auth' middleware to ensure user is logged in
// Uses 'isAdmin' middleware to ensure user has admin role
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        // Resource route for product CRUD operations
        // Generates routes: index, create, store, show, edit, update, destroy
        Route::resource('products', AdminProductController::class);
    });

// Include authentication routes (login, register, password reset, etc.)
require __DIR__.'/auth.php';
