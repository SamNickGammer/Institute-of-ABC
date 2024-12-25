<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AdminLoginControllerAPI;
use App\Http\Controllers\api\AdminBranchControllerAPI;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/login', [AdminLoginControllerAPI::class, 'login'])->name('login');
    Route::post('/logout', [AdminLoginControllerAPI::class, 'logout'])->name('logout');

    //Main Routing regurding work
    Route::post('/branch/register', [AdminBranchControllerAPI::class, 'createBranch']);
});