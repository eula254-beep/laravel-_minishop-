<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Shop\ShopController;
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
| 2. Authentication routes
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
// AUTHENTICATION ROUTES
// ========================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

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

