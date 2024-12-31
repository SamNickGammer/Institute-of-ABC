<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        return view('welcome', [
            'component' => 'pages.course'
        ]);
    }
}