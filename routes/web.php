<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index']);

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
});

// Logout route (accessible by authenticated users)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Members routes
    Route::resource('members', MemberController::class);

    // Ministries routes
    Route::resource('ministries', MinistryController::class);

    // Events routes
    Route::resource('events', EventController::class);

    // Finance routes
    Route::get('finances', [FinanceController::class, 'index'])->name('finances.index');
    Route::get('finances/offerings/create', [FinanceController::class, 'createOffering'])->name('finances.create-offering');
    Route::post('finances/offerings', [FinanceController::class, 'storeOffering'])->name('finances.store-offering');
    Route::get('finances/offerings/{id}/edit', [FinanceController::class, 'editOffering'])->name('finances.edit-offering');
    Route::put('finances/offerings/{id}', [FinanceController::class, 'updateOffering'])->name('finances.update-offering');
    Route::delete('finances/offerings/{id}', [FinanceController::class, 'destroyOffering'])->name('finances.destroy-offering');
    Route::get('finances/expenses/create', [FinanceController::class, 'createExpense'])->name('finances.create-expense');
    Route::post('finances/expenses', [FinanceController::class, 'storeExpense'])->name('finances.store-expense');
    Route::get('finances/expenses/{id}/edit', [FinanceController::class, 'editExpense'])->name('finances.edit-expense');
    Route::put('finances/expenses/{id}', [FinanceController::class, 'updateExpense'])->name('finances.update-expense');
    Route::delete('finances/expenses/{id}', [FinanceController::class, 'destroyExpense'])->name('finances.destroy-expense');

    // Users routes
    Route::resource('users', UserController::class);
});
