<?php

namespace App\Http\Controllers\web\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminControllerWEB extends Controller
{
    public function login()
    {
        return view('superadmin.pages.login');
    }

    public function dashboard()
    {
        return view('superadmin.superadmin', [
            'component' => 'superadmin.pages.dashboard'
        ]);
    }

    public function allStudents()
    {
        return view('superadmin.superadmin', [
            'component' => 'superadmin.pages.all-students'
        ]);
    }

    public function certificateApprovals()
    {
        return view('superadmin.superadmin', [
            'component' => 'superadmin.pages.certificate-approvals'
        ]);
    }

    public function branches()
    {
        return view('superadmin.superadmin', [
            'component' => 'superadmin.pages.branches'
        ]);
    }

    public function courses()
    {
        return view('superadmin.superadmin', [
            'component' => 'superadmin.pages.courses'
        ]);
    }

    public function studentDetail()
    {
        return view('superadmin.superadmin', [
            'component' => 'superadmin.pages.student-detail'
        ]);
    }

    public function editStudent()
    {
        return view('superadmin.superadmin', [
            'component' => 'superadmin.pages.edit-student'
        ]);
    }

    public function branchDetail()
    {
        return view('superadmin.superadmin', [
            'component' => 'superadmin.pages.branch-detail'
        ]);
    }
}
