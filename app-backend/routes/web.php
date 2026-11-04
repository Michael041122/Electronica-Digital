<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuoteLeadController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductKitAdminController;

// 1. Rutas Públicas (Con Rate Limiting para evitar SPAM de cotizaciones)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/api/quote-leads', [QuoteLeadController::class, 'store'])
    ->middleware('throttle:15,1')
    ->name('quote-leads.store');

// 2. Autenticación (Login protegido contra ataques de fuerza bruta: máx 5 intentos por minuto)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 3. Módulo Administrativo Protegido con Middleware 'auth'
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('kits', ProductKitAdminController::class);
});
