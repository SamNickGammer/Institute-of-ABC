<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLoginControllerAPI extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('branchId', 'password');
        $results = DB::table('users')->get();

        // if (Auth::guard('user')->attempt($credentials)) {
        //     $request->session()->put('is_admin_logged_in', true);
        //     return response()->json(['message' => 'Login successful']);
        // }

        return response()->json([
            'message' => 'Login successful',
            'data' => $credentials,
            'result' => $results
        ]);
    }

    public function logout(Request $request)
    {
        // $request->session()->put('is_admin_logged_in', false);
        // return response()->json(['message' => 'Logout successful']);
        return response()->json(['message' => 'Logout successful']);
    }
}
