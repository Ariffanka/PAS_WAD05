<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockMovementController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/stock-movements', [StockMovementController::class, 'index'])
        ->name('stock-movements.index');

    Route::get('/stock-movements/create', [StockMovementController::class, 'create'])
        ->name('stock-movements.create');

    Route::post('/stock-movements', [StockMovementController::class, 'store'])
        ->name('stock-movements.store');

    Route::middleware('role:admin')->group(function () {
        Route::resource('products', ProductController::class)
            ->except('show');

        Route::resource('categories', CategoryController::class)
            ->except('show');

        Route::resource('suppliers', SupplierController::class)
            ->except('show');
    });
});

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::middleware('role:admin')->group(function () {

    Route::resource('products', ProductController::class)
        ->except(['show', 'index']);

    Route::resource('categories', CategoryController::class)
        ->except('show');

    Route::resource('suppliers', SupplierController::class)
        ->except('show');

});