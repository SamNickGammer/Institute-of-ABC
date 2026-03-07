<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ADMINDashboardControllerWEB extends Controller
{
    public function dashboard()
    {
        return view('admin.admin', [
            'component' => 'admin.pages.dashboard'
        ]);
    }

    public function allStudents()
    {
        return view('admin.admin', [
            'component' => 'admin.pages.all-students'
        ]);
    }

    public function addStudent()
    {
        return view('admin.admin', [
            'component' => 'admin.pages.add-student'
        ]);
    }

    public function editStudent()
    {
        return view('admin.admin', [
            'component' => 'admin.pages.edit-student'
        ]);
    }

    public function studentDetail()
    {
        return view('admin.admin', [
            'component' => 'admin.pages.student-detail'
        ]);
    }

    public function recentApproved()
    {
        return view('admin.admin', [
            'component' => 'admin.pages.recent-approved'
        ]);
    }

    public function marksheetManagement()
    {
        return view('admin.admin', [
            'component' => 'admin.pages.marksheet-management'
        ]);
    }

    public function updateMarksheet()
    {
        return view('admin.admin', [
            'component' => 'admin.pages.update-marksheet'
        ]);
    }
}
