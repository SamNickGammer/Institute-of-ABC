<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\admin\ADMINLoginControllerWEB;
use App\Http\Controllers\web\admin\ADMINDashboardControllerWEB;
use App\Http\Middleware\AdminAuthMiddleware;


Route::get('/', [HomeController::class, 'index'])->name('home');


// Protected routes for Admin UI
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [ADMINLoginControllerWEB::class, 'login'])->name('login');
    Route::middleware(AdminAuthMiddleware::class)->group(function () {
        Route::get('/', [ADMINDashboardControllerWEB::class, 'dashboard'])->name('/'); // Protected dashboard
    });
});