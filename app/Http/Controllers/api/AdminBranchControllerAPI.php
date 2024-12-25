<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Utils\GenerateRandomStuff;
use App\Utils\EncryptionAndCompare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminBranchControllerAPI extends Controller
{
    public function createBranch(Request $request){
      $validator = Validator::make($request->all(), [
        'phone' => 'required|string|max:15',
        'email_id' => 'required|email|max:255',
        'branch_code' => 'required|string|max:50',
        'branch_name' => 'required|string|max:255',
        'address_line1' => 'required|string|max:255',
        'address_line2' => 'nullable|string|max:255',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'zip' => 'required|integer',
        'first_name' => 'required|string|max:100',
        'last_name' => 'nullable|string|max:100',
      ]);

      if ($validator->fails()) {
        return response()->json([
            'error' => true,
            'message' => 'Validation failed.',
            'errors' => $validator->errors(),
        ], 422);
      }
      $validated = $validator->validated();


    try {
        // Check if branch_code already exists
        $existingBranch = DB::table('branch')
            ->where('branch_code', $validated['branch_code'])
            ->first();

        if ($existingBranch) {
            return response()->json([
                "error" => true,
                'code' => 409,
                'message' => 'Branch with this code already exists',
                'data' => [],
            ], 409);
        }

        DB::beginTransaction();

        $initialPassword = GenerateRandomStuff::password(9);
        $adminProfileId = DB::table('branch')->insertGetId([
            "phone" => $validated['phone'],
            "email_id" => $validated['email_id'],
            "branch_code" => $validated['branch_code'],
            "branch_name" => $validated['branch_name'],
            "address_line1" => $validated['address_line1'],
            "address_line2" => $validated['address_line2'] ?? null,
            "city" => $validated['city'],
            "state" => $validated['state'],
            "zip" => $validated['zip'],
            "first_name" => $validated['first_name'],
            "last_name" => $validated['last_name'] ?? null,
            "active" => true,
            "pass" => $initialPassword,
            "password" => EncryptionAndCompare::hash($initialPassword),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (!$adminProfileId) {
            throw new \Exception('Failed to create branch');
        }

        $response = DB::table('branch')->where('id', $adminProfileId)->first();

        DB::commit();

        return response()->json([
            "error" => false,
            'code' => 201,
            'message' => 'Branch created successfully',
            'data' => $response,
        ], 201);
    } catch (\Exception $e) {
        DB::rollBack();

        Log::error('Branch creation failed', [
            'error' => $e->getMessage(),
            'request' => $request->all(),
        ]);

        return response()->json([
            "error" => true,
            'code' => 500,
            'message' => 'Internal server error',
            'data' => [],
        ], 500);
    }
    }

}
