<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ADMINDashboardControllerWEB extends Controller
{
    //
    public function dashboard()
    {
        return view('admin.admin',[
            'component' => 'admin.pages.dashboard'
        ]);
    }
}
