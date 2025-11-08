<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UrlShortenerController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login/verify', [AuthController::class, 'verify'])->name('login.verify');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(RoleMiddleware::class . ':SuperAdmin')->group(function () {
        // CPOMPANY CONTROLLER ROUTES
        Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
        Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');
        Route::post('/company/store', [CompanyController::class, 'store'])->name('company.store');

        // ADMIN CONTROLLER ROUTES
        Route::get('/admin', [UserController::class, 'index'])->name('admin.index');
        Route::get('/admin/create', [UserController::class, 'create'])->name('admin.create');
        Route::post('/admin/store', [UserController::class, 'store'])->name('admin.store');
    });

    Route::middleware(RoleMiddleware::class . ':SuperAdmin,Admin')->group(function () {
        // ADMIN CONTROLLER ROUTES
        Route::get('/admin', [UserController::class, 'index'])->name('admin.index');
        Route::get('/admin/create', [UserController::class, 'create'])->name('admin.create');
        Route::post('/admin/store', [UserController::class, 'store'])->name('admin.store');
    });


    Route::middleware(['role:Admin,Member'])->group(function () {
        // URL CONTROLLER ROUTES
        Route::get('/url/create', [UrlShortenerController::class, 'create'])->name('url.create');
        Route::post('/url/store', [UrlShortenerController::class, 'store'])->name('url.store');
        Route::get('/url/list', [UrlShortenerController::class, 'index'])->name('url.index');
    });
});


Route::get('/s/{code}', [UrlShortenerController::class, 'redirect'])->name('url.redirect');
