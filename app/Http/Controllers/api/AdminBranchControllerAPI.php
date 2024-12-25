<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Utils\GenerateRandomStuff;
use App\Utils\EncryptionAndCompare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminBranchControllerAPI extends Controller
{
    public function createBranch(Request $request){

        $phone = $request->phone;
        $email_id = $request->email_id;
        $branch_code = $request->branch_code;
        $branch_name = $request->branch_name;
        $address_line1 = $request->address_line1;
        $address_line2 = $request->address_line2;
        $city = $request->city;
        $state = $request->state;
        $zip = $request->zip;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        

        //check if the branch_code is same or not if same then need to 
        // send message error that cann not create because exist.

        $initialPassword = GenerateRandomStuff::password(9);
  
        $adminProfileId = DB::table('branch')->insertGetId([
          "phone" => $phone,
          "email_id" => $email_id,
          "branch_code" => $branch_code,
          "branch_name" => $branch_name,
          "address_line1" => $address_line1,
          "address_line2" => $address_line2,
          "city" => $city,
          "state" => $state,
          "zip" => $zip,
          "first_name" => $first_name,
          "last_name" => $last_name,
          "active" => true,
          "pass" => $initialPassword,
          "password" => EncryptionAndCompare::hash($initialPassword)
        ]);

        if($adminProfileId) {
          $response = DB::table('branch')->where('id', $adminProfileId)->first();
          return response()->json([
            "error" => false,
            'code' => 200,
            'message' => 'Created Branch Sucessfully',
            'data' => $response,
          ]);
        } else {
          return response()->json([
            "error" => true,
            'code' => 400,
            'message' => 'Error Creating Branch',
            'data' => [],
          ]);
        }
      }

}
