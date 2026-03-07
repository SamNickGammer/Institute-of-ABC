<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\AboutController;
use App\Http\Controllers\web\CourseController;
use App\Http\Controllers\web\GalleryController;
use App\Http\Controllers\web\StudentInfoController;
use App\Http\Controllers\web\admin\ADMINLoginControllerWEB;
use App\Http\Controllers\web\admin\ADMINDashboardControllerWEB;
use App\Http\Controllers\web\superadmin\SuperAdminControllerWEB;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/course', [CourseController::class, 'index'])->name('course');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/student_info', [StudentInfoController::class, 'index'])->name('student_info');


// Branch Panel (was /admin, now /branch)
Route::prefix('branch')->name('branch.')->group(function () {
    Route::get('/login', [ADMINLoginControllerWEB::class, 'login'])->name('login');

    Route::get('/', [ADMINDashboardControllerWEB::class, 'dashboard'])->name('dashboard');
    Route::get('/all-students', [ADMINDashboardControllerWEB::class, 'allStudents'])->name('allStudents');
    Route::get('/add-student', [ADMINDashboardControllerWEB::class, 'addStudent'])->name('addStudent');
    Route::get('/edit-student', [ADMINDashboardControllerWEB::class, 'editStudent'])->name('editStudent');
    Route::get('/student', [ADMINDashboardControllerWEB::class, 'studentDetail'])->name('studentDetail');
    Route::get('/recent-approved', [ADMINDashboardControllerWEB::class, 'recentApproved'])->name('recentApproved');
    Route::get('/marksheet-management', [ADMINDashboardControllerWEB::class, 'marksheetManagement'])->name('marksheetManagement');
    Route::get('/update-marksheet', [ADMINDashboardControllerWEB::class, 'updateMarksheet'])->name('updateMarksheet');
});

// Keep /admin as redirect to /branch for backwards compatibility
Route::get('/admin/login', function () { return redirect('/branch/login'); });
Route::get('/admin/{any?}', function ($any = '') { return redirect('/branch/' . $any); })->where('any', '.*');

// Super Admin Panel
Route::prefix('admin-abc')->name('superadmin.')->group(function () {
    Route::get('/login', [SuperAdminControllerWEB::class, 'login'])->name('login');
    Route::get('/', [SuperAdminControllerWEB::class, 'dashboard'])->name('dashboard');
    Route::get('/all-students', [SuperAdminControllerWEB::class, 'allStudents'])->name('allStudents');
    Route::get('/certificate-approvals', [SuperAdminControllerWEB::class, 'certificateApprovals'])->name('certificateApprovals');
    Route::get('/branches', [SuperAdminControllerWEB::class, 'branches'])->name('branches');
    Route::get('/courses', [SuperAdminControllerWEB::class, 'courses'])->name('courses');
    Route::get('/student', [SuperAdminControllerWEB::class, 'studentDetail'])->name('studentDetail');
    Route::get('/edit-student', [SuperAdminControllerWEB::class, 'editStudent'])->name('editStudent');
    Route::get('/branch-detail', [SuperAdminControllerWEB::class, 'branchDetail'])->name('branchDetail');
});
