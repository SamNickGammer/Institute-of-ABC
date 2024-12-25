<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ADMINLoginControllerWEB extends Controller
{
    //
    public function login()
    {
        return view('admin.pages.login');
    }
}
