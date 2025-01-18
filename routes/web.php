<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\AboutController;
use App\Http\Controllers\web\CourseController;
use App\Http\Controllers\web\GalleryController;
use App\Http\Controllers\web\StudentInfoController;
use App\Http\Controllers\web\admin\ADMINLoginControllerWEB;
use App\Http\Controllers\web\admin\ADMINDashboardControllerWEB;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/course', [CourseController::class, 'index'])->name('course');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/student_info', [StudentInfoController::class, 'index'])->name('student_info');


// Protected routes for Admin UI
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [ADMINLoginControllerWEB::class, 'login'])->name('login');

    Route::get('/', [ADMINDashboardControllerWEB::class, 'dashboard'])->name('dashboard');
    Route::get('/add-new-student', [ADMINDashboardControllerWEB::class, 'dashboard'])->name('addNewStudent');
    Route::get('/all-students', [ADMINDashboardControllerWEB::class, 'dashboard'])->name('allStudents');
    
});