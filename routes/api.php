<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AdminLoginControllerAPI;
use App\Http\Controllers\api\AdminBranchControllerAPI;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/login', [AdminLoginControllerAPI::class, 'login']);
    Route::post('/logout', [AdminLoginControllerAPI::class, 'logout']);

    //Main Routing regurding work
    Route::get('/branch', [AdminBranchControllerAPI::class, 'getBranchDetails']);
    Route::get('/branch/getAll', [AdminBranchControllerAPI::class, 'getAllBranch']);
    Route::post('/branch/register', [AdminBranchControllerAPI::class, 'createBranch']);
    Route::post('/branch/change_password', [AdminBranchControllerAPI::class, 'changePasswordForBranch']);
    Route::post('/branch/reset_password', [AdminBranchControllerAPI::class, 'resetPasswordForBranch']);
    Route::post('/branch/update', [AdminBranchControllerAPI::class, 'updateBranch']);
    Route::post('/branch/update/status', [AdminBranchControllerAPI::class, 'changeBranchActiveStatus']);
    
    
    Route::post('/branch/add_course', [AdminBranchControllerAPI::class, 'addCourse']);
    Route::post('/branch/delete_course', [AdminBranchControllerAPI::class, 'deleteCourse']);
    Route::get('/branch/get_all_courses', [AdminBranchControllerAPI::class, 'getAllCourses']);

    Route::post('/branch/student/get_relieving_date', [AdminBranchControllerAPI::class, 'calculateRelievingDate']);
    Route::post('/branch/student/get_next_reg_no', [AdminBranchControllerAPI::class, 'getNextRegistrationNumber']);
    Route::post('/branch/add_student', [AdminBranchControllerAPI::class, 'addStudent']);
    Route::post('/branch/update_student', [AdminBranchControllerAPI::class, 'updateStudent']);
    Route::post('/branch/delete_student', [AdminBranchControllerAPI::class, 'deleteStudent']);
    Route::post('/branch/student/add_marksheet', [AdminBranchControllerAPI::class, 'updateMarksheet']);
    Route::post('/branch/student/add_certification', [AdminBranchControllerAPI::class, 'updateMarksWithCertification']);
    Route::post('/branch/get_all_students', [AdminBranchControllerAPI::class, 'getStudentsByBranch']);
    Route::get('/branch/student/get_next_marksheet_no', [AdminBranchControllerAPI::class, 'getNextMarksheetId']);
    Route::post('/branch/get_student_details', [AdminBranchControllerAPI::class, 'getStudentDetailsByRegistrationNumber']);
    
    Route::post('/branch/add_credit', [AdminBranchControllerAPI::class, 'addCreditToBranch']);
});

