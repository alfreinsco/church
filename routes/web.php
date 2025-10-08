<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FinanceController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Members routes
Route::resource('members', MemberController::class);

// Ministries routes
Route::resource('ministries', MinistryController::class);

// Events routes
Route::resource('events', EventController::class);

// Finance routes
Route::resource('finances', FinanceController::class);
