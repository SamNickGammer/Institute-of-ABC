<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Utils\EncryptionAndCompare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminLoginControllerAPI extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branchCode' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        $isBranchAvailable = DB::table('branch')
                                ->where(DB::raw('LOWER(branch_code)'), strtolower($validated['branchCode']))
                                ->first();

        if (!$isBranchAvailable) {
            return response()->json([
                'error' => true,
                'message' => 'Branch not found.',
            ], 404);
        }

        // Compare the hashed password
        if (!EncryptionAndCompare::compare($validated['password'], $isBranchAvailable->password)){
            return response()->json([
                'error' => true,
                'message' => 'Invalid credentials.',
            ], 401);
        }

        // Prepare response data
        $responseData = [
            'email' => $isBranchAvailable->email_id,
            'branchCode' => $isBranchAvailable->branch_code,
            'branchName' => $isBranchAvailable->branch_name,
            'image' => $isBranchAvailable->image,
            'firstName' => $isBranchAvailable->first_name,
            'state' => $isBranchAvailable->state,
            'city' => $isBranchAvailable->city,
            'zip' => $isBranchAvailable->zip,
            'addressLine1' => $isBranchAvailable->address_line1,
            'addressLine2' => $isBranchAvailable->address_line2,
            'role' => $isBranchAvailable->role,
            'active' => $isBranchAvailable->active,
        ];

        return response()->json([
            'error' => false,
            'message' => 'Login successful.',
            'data' => $responseData,
        ], 200);

    }

    public function logout(Request $request)
    {
        // $request->session()->put('is_admin_logged_in', false);
        // return response()->json(['message' => 'Logout successful']);
        return response()->json(['message' => 'Logout successful']);
    }
}
