<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Utils\GenerateRandomStuff;
use App\Utils\EncryptionAndCompare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminBranchControllerAPI extends Controller
{
    public function getAllBranch(Request $request)
    {
        try {
            $showActiveOnly = $request->input('showActiveOnly', false);

            $branches = DB::table('branch')
                ->when($showActiveOnly, function ($query) {
                    return $query->where('active', true);
                })
                ->get();

            if ($branches->isEmpty()) {
                return response()->json([
                    'error' => true,
                    'message' => 'No branches found.',
                    'data' => [],
                ], 404);
            }

            return response()->json([
                'error' => false,
                'message' => 'Branches fetched successfully.',
                'data' => $branches,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Fetching branches failed', ['error' => $e->getMessage()]);

            return response()->json([
                'error' => true,
                'message' => 'Internal server error.',
            ], 500);
        }
    }

    public function getBranchDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_code' =>  'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $validated = $validator->validated();

            $branch =  DB::table('branch')
                ->where(DB::raw('LOWER(branch_code)'), strtolower($validated['branch_code']))
                ->first();

            if (!$branch) {
                return response()->json([
                    'error' => true,
                    'message' => 'Branch not found.',
                ], 404);
            }

            return response()->json([
                'error' => false,
                'message' => 'Branch details fetched successfully.',
                'data' => $branch,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Fetching branch details failed', ['error' => $e->getMessage()]);

            return response()->json([
                'error' => true,
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function createBranch(Request $request)
    {
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
        'manager_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'credit' => "nullable|integer"
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

            $initialPassword = 123456789;
            // $initialPassword = GenerateRandomStuff::password(9);
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
                "center_creation_date" => now()->format('Y-m-d'),
                'credit' => $validated['credit'] ?? 0
            ]);

            if (!$adminProfileId) {
                throw new \Exception('Failed to create branch');
            }

            // Handle manager photo upload and processing
            if ($request->hasFile('manager_photo')) {
                $image = $request->file('manager_photo');
                
                // Create directory for manager photos if not exists
                $directoryPath = 'manager/' . $adminProfileId;
                // $directoryPath = public_path('manager/' . $adminProfileId);
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }

                $imagePath = $directoryPath . '/' . $image->getClientOriginalName();
                Image::make($image)->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($imagePath);

                // Update manager_photo URL
                $imageUrl = url('manager/' . $adminProfileId . '/' . $image->getClientOriginalName());
                DB::table('branch')->where('id', $adminProfileId)->update(['image' => $imageUrl]);
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

    public function resetPasswordForBranch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_code' => 'required|string|max:50',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        try {
            $validated = $validator->validated();
    
            // Check if branch exists
            $branch = DB::table('branch')
                ->where(DB::raw('LOWER(branch_code)'), strtolower($validated['branch_code']))
                ->first();
    
            if (!$branch) {
                return response()->json([
                    'error' => true,
                    'message' => 'Branch not found.',
                ], 404);
            }
    
            $newPassword = GenerateRandomStuff::password(9);
            DB::table('branch')
                ->where('id', $branch->id)
                ->update([
                    'pass' => $newPassword,
                    'password' => EncryptionAndCompare::hash($newPassword),
                    'updated_at' => now(),
                ]);
    
            //TODO: You may send the new password via email or any other notification mechanism
    
            return response()->json([
                'error' => false,
                'message' => 'Password reset successfully.',
                'data' => [
                    'branch_code' => $branch->branch_code,
                    'new_password' => $newPassword,
                ],
            ], 200);
        } catch (\Exception $e) {
            Log::error('Password reset failed', ['error' => $e->getMessage()]);
    
            return response()->json([
                'error' => true,
                'message' => 'Internal server error',
            ], 500);
        }
    }
    
    public function changePasswordForBranch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_code' => 'required|string|max:50',
            'currentPassword' => 'required|string|min:6',
            'newPassword' => 'required|string|min:6|different:currentPassword',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        try {
            $validated = $validator->validated();
    
            // Check if branch exists
            $branch =  DB::table('branch')
                ->where(DB::raw('LOWER(branch_code)'), strtolower($validated['branch_code']))
                ->first();
    
            if (!$branch) {
                return response()->json([
                    'error' => true,
                    'message' => 'Branch not found.',
                ], 404);
            }
    
            // Verify current password
            if (!EncryptionAndCompare::compare($validated['currentPassword'], $branch->password)) {
                return response()->json([
                    'error' => true,
                    'message' => 'Current password is incorrect.',
                ], 401);
            }
    
            // Update to the new password
            DB::table('branch')
                ->where('id', $branch->id)
                ->update([
                    'pass' => $validated['newPassword'],
                    'password' => EncryptionAndCompare::hash($validated['newPassword']),
                    'updated_at' => now(),
                ]);
    
            return response()->json([
                'error' => false,
                'message' => 'Password changed successfully.',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Password change failed', ['error' => $e->getMessage()]);
    
            return response()->json([
                'error' => true,
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function updateBranch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_code' => 'required|string|max:50',
            'first_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|integer',
            'phone' => 'nullable|string|max:15',
            'email_id' => 'nullable|email|max:255',
            'image' => 'nullable|string', 
            'manager_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            $branch =  DB::table('branch')
                ->where(DB::raw('LOWER(branch_code)'), strtolower($validated['branch_code']))
                ->first();

            if (!$branch) {
                return response()->json([
                    'error' => true,
                    'message' => 'Branch not found.',
                ], 404);
            }

            
            $updatedFields = [
                'first_name' => $validated['first_name'] ?? $branch->first_name,
                'last_name' => $validated['last_name'] ?? $branch->last_name,
                'address_line1' => $validated['address_line1'] ?? $branch->address_line1,
                'address_line2' => $validated['address_line2'] ?? $branch->address_line2,
                'city' => $validated['city'] ?? $branch->city,
                'state' => $validated['state'] ?? $branch->state,
                'zip' => $validated['zip'] ?? $branch->zip,
                'phone' => $validated['phone'] ?? $branch->phone,
                'email_id' => $validated['email_id'] ?? $branch->email_id,
                'updated_at' => now(),
            ];
            
            DB::table('branch')
            ->where(DB::raw('LOWER(branch_code)'), strtolower($validated['branch_code']))
            ->update($updatedFields);
            
            if ($request->hasFile('manager_photo')) {
                $image = $request->file('manager_photo');
                
                $directoryPath = 'manager/' . $branch->id;
                // $directoryPath = public_path('manager/' . $branch->id);
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }

                $imagePath = $directoryPath . '/' . $image->getClientOriginalName();
                Image::make($image)->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($imagePath);

                // Update manager_photo URL
                $imageUrl = url('manager/' . $branch->id . '/' . $image->getClientOriginalName());
                DB::table('branch')->where('id', $branch->id)->update(['image' => $imageUrl]);
            }

            $response = DB::table('branch')->where('id', $branch->id)->first();
            
            return response()->json([
                'error' => false,
                'message' => 'Branch updated successfully.',
                'data' => $response,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Updating branch failed', ['error' => $e->getMessage()]);

            return response()->json([
                'error' => true,
                'message' => 'Internal server error.',
            ], 500);
        }
    }

    public function changeBranchActiveStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_code' => 'required|string|max:50',
            'active' => 'required|boolean',
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
            $branch = DB::table('branch')
                ->where('branch_code', strtolower($validated['branch_code']))
                ->first();

            if (!$branch) {
                return response()->json([
                    'error' => true,
                    'message' => 'Branch not found.',
                ], 404);
            }

            DB::table('branch')
                ->where('branch_code', strtolower($validated['branch_code']))
                ->update(['active' => $validated['active'], 'updated_at' => now()]);

            return response()->json([
                'error' => false,
                'message' => 'Branch active status updated successfully.',
                'data' => [
                    'branch_code' => $validated['branch_code'],
                    'active' => $validated['active'],
                ],
            ], 200);
        } catch (\Exception $e) {
            Log::error('Updating branch active status failed', ['error' => $e->getMessage()]);

            return response()->json([
                'error' => true,
                'message' => 'Internal server error.',
            ], 500);
        }
    }


    public function addCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_name' => 'required|string|max:255|unique:courses',
            'short_form' => 'required|string|max:10|unique:courses',
            'course_duration' => 'required|integer|max:50',
            'course_fees' => 'required|numeric|min:0',
            'subjects' => 'nullable|string'
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
            $courseId = DB::table('courses')->insertGetId([
                'course_name' => $validated['course_name'],
                'short_form' => $validated['short_form'],
                'course_duration' => $validated['course_duration'],
                'course_fees' => $validated['course_fees'],
                'course_status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
                "subjects" => $validated['subjects'] ?? 'Written Marks, Practical Marks, Project Marks, Viva Marks'
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Course added successfully.',
                'data' => ['course_id' => $courseId],
            ], 201);
        } catch (\Exception $e) {
            Log::error('Adding course failed', ['error' => $e->getMessage()]);

            return response()->json([
                'error' => true,
                'message' => 'Internal server error.',
            ], 500);
        }
    }

    public function deleteCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer|exists:courses,course_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            DB::table('courses')
                ->where('course_id', $request->course_id)
                ->delete();

            return response()->json([
                'error' => false,
                'message' => 'Course deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Deleting course failed', ['error' => $e->getMessage()]);

            return response()->json([
                'error' => true,
                'message' => 'Internal server error.',
            ], 500);
        }
    }

    public function getAllCourses(Request $request)
    {
        $showActiveOnly = $request->input('showActiveOnly', false);

        try {
            $query = DB::table('courses')->select('course_id', 'course_name', 'short_form', 'course_duration', 'course_fees', 'course_status', 'created_at', 'updated_at');

            if ($showActiveOnly) {
                $query->where('course_status', 'active');
            }

            $courses = $query->get();

            

            return response()->json([
                'error' => false,
                'message' => 'Courses retrieved successfully.',
                'data' => $courses,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Fetching courses failed', ['error' => $e->getMessage()]);

            return response()->json([
                'error' => true,
                'message' => 'Internal server error.',
            ], 500);
        }
    }
    //Todo
    public function updateCoursePrice(Request $request){}
    //Todo
    public function updateFeeDetails(Request $request){}
    //Todo
    public function getFeeDetails(Request $request){}

    public function calculateRelievingDate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admission_date' => 'required|date|date_format:Y-m-d',
            'course_id' => 'required|exists:courses,course_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        $courseDuration = DB::table('courses')
            ->where('course_id', $validated['course_id'])
            ->value('course_duration');

        if (!$courseDuration) {
            return response()->json([
                'error' => true,
                'message' => 'Invalid course_id or course duration not set.'
            ], 400);
        }

        return Carbon::parse($validated['admission_date'])->addMonths($courseDuration)->addDays(1)->format('Y-m-d');
    }

    public function getNextRegistrationNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:branch,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

    
        $validated = $validator->validated();

        $branchCode = DB::table('branch')->where('id', $validated['branch_id'])->value('branch_code');

        if (!$branchCode) {
            return response()->json([
                'error' => true,
                'message' => 'Invalid branch_id or branch code not set.'
            ], 400);
        }

        $lastRegistration = DB::table('student')
            ->where('branch_id', $validated['branch_id'])
            ->orderBy('registration_number', 'desc')
            ->value('registration_number');

        if (!$lastRegistration) {
            return $branchCode . '0001';
        }

        // Extract numeric part after branch code
        $sequenceNumber = (int) substr($lastRegistration, strlen($branchCode));
        $nextSequence = str_pad($sequenceNumber + 1, 4, '0', STR_PAD_LEFT);

        return $branchCode . $nextSequence;
    }



    public function addStudent(Request $request){
        $validator = Validator::make($request->all(), [
           'student_name' => 'required|string|max:255',
            'registration_number' => 'required|string|unique:student,registration_number',
            'student_email' => 'nullable|email|max:255',
            'student_phone' => 'required|digits:10',
            'student_father_name' => 'nullable|string|max:255',
            'student_mother_name' => 'nullable|string|max:255',
            'branch_id' => 'required|exists:branch,id',
            'student_course_id' => 'required|exists:courses,course_id',
            'dob' => 'required|date|date_format:Y-m-d',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:10',
            'admission_date' => 'required|date|date_format:Y-m-d',
            'relieving_date' => 'nullable|date|date_format:Y-m-d|after_or_equal:admission_date',
            'student_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aadhaar_number' => 'string|required|max:16'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        try {
            $existingStudent = DB::table('student')
                ->where('aadhaar_number', $data['aadhaar_number'])
                ->first();

            if ($existingStudent) {
                return response()->json([
                    "error" => true,
                    'code' => 409,
                    'message' => 'This Aadhaar card is already registered!',
                    'data' => $existingStudent,
                ], 409);
            }

            DB::beginTransaction();

            $totalFees = DB::table('courses')->where('course_id', $data['student_course_id'])->value('course_fees');

            $studentId = DB::table('student')->insertGetId([
                'student_name' => $data['student_name'],
                'registration_number' => $data['registration_number'],
                'student_email' => $data['student_email'] ?? null,
                'student_phone' => '+91' . $data['student_phone'],
                'student_father_name' => $data['student_father_name'] ?? null,
                'student_mother_name' => $data['student_mother_name'] ?? null,
                'branch_id' => $data['branch_id'],
                'student_course_id' => $data['student_course_id'],
                'dob' => $data['dob'],
                'address' => $data['address'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
                'zip' => $data['zip'] ?? null,
                'admission_date' => $data['admission_date'],
                'relieving_date' => $data['relieving_date'],
                'total_fees' => $totalFees,
                'aadhaar_number' => $data['aadhaar_number'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            if (!$studentId) {
                throw new \Exception('Failed to create Student');
            }

            // Handle Imaeg
            if ($request->hasFile('student_photo')) {
                $image = $request->file('student_photo');
                
                // Create directory for manager photos if not exists
                $directoryPath = 'student_photo/' . $studentId;
                // $directoryPath = public_path('student_photo/' . $studentId);
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }

                $imagePath = $directoryPath . '/' . $image->getClientOriginalName();
                Image::make($image)->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($imagePath);

                // Update manager_photo URL
                $imageUrl = url('student_photo/' . $studentId . '/' . $image->getClientOriginalName());
                DB::table('student')->where('student_id', $studentId)->update(['student_photo' => $imageUrl]);
            }

            $response = DB::table('student')->where('student_id', $studentId)->first();

            DB::commit();

            return response()->json([
                "error" => false,
                'code' => 201,
                'message' => 'Student created successfully',
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

    public function updateStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:student,student_id',
            'student_name' => 'nullable|string|max:255',
            'student_email' => 'nullable|email|max:255',
            'student_phone' => 'nullable|digits:10',
            'student_father_name' => 'nullable|string|max:255',
            'student_mother_name' => 'nullable|string|max:255',
            'student_course_id' => 'nullable|exists:courses,course_id',
            'dob' => 'nullable|date|date_format:Y-m-d',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:10',
            'admission_date' => 'nullable|date|date_format:Y-m-d',
            'relieving_date' => 'nullable|date|date_format:Y-m-d|after_or_equal:admission_date',
            'student_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        try {
            $student = DB::table('student')->where('student_id', $data['student_id'])->first();

            if (!$student) {
                return response()->json([
                    "error" => true,
                    'code' => 404,
                    'message' => 'Student not found',
                ], 404);
            }

            // Check if updates are allowed
            if (!$student->is_student_active && $student->is_student_deleted && $student->is_certificate_approve) {
                return response()->json([
                    "error" => true,
                    'code' => 403,
                    'message' => 'Student update not allowed due to status conditions',
                ], 403);
            }

            // Disallowed updates
            if ($request->has('aadhaar_number') || $request->has('registration_number') || $request->has('branch_id')) {
                return response()->json([
                    "error" => true,
                    'code' => 400,
                    'message' => 'Cannot update Aadhaar number, registration number, or branch ID',
                ], 400);
            }

            DB::beginTransaction();

            // If course ID is updated, update total fees
            if (isset($data['student_course_id']) && $data['student_course_id'] != $student->student_course_id) {
                $totalFees = DB::table('courses')->where('course_id', $data['student_course_id'])->value('course_fees');
                $data['total_fees'] = $totalFees;
            }

            // Update student record
            DB::table('student')->where('student_id', $data['student_id'])->update(array_merge($data, [
                'updated_at' => now(),
            ]));

            // Handle image update
            if ($request->hasFile('student_photo')) {
                $image = $request->file('student_photo');

                $directoryPath = 'student_photo/' . $data['student_id'];
                // $directoryPath = public_path('student_photo/' . $data['student_id']);
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }

                $imagePath = $directoryPath . '/' . $image->getClientOriginalName();
                Image::make($image)->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($imagePath);

                $imageUrl = url('student_photo/' . $data['student_id'] . '/' . $image->getClientOriginalName());
                DB::table('student')->where('student_id', $data['student_id'])->update(['student_photo' => $imageUrl]);
            }

            $response = DB::table('student')->where('student_id', $data['student_id'])->first();

            DB::commit();

            return response()->json([
                "error" => false,
                'code' => 200,
                'message' => 'Student updated successfully',
                'data' => $response,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Student update failed', [
                'error' => $e->getMessage(),
                'request' => $request->all(),
            ]);

            return response()->json([
                "error" => true,
                'code' => 500,
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function deleteStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:student,student_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        try {
            $student = DB::table('student')->where('student_id', $data['student_id'])->first();

            if (!$student) {
                return response()->json([
                    'error' => true,
                    'code' => 404,
                    'message' => 'Student not found',
                ], 404);
            }

            // Check if the student is certified
            if ($student->certified_date || $student->is_certificate_approve) {
                return response()->json([
                    'error' => true,
                    'code' => 403,
                    'message' => 'Cannot delete the student as they are certified',
                ], 403);
            }

            // Delete the student
            $deleted = DB::table('student')->where('student_id', $data['student_id'])->delete();

            if (!$deleted) {
                throw new \Exception('Failed to delete the student');
            }

            return response()->json([
                'error' => false,
                'code' => 200,
                'message' => 'Student deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Student deletion failed', [
                'error' => $e->getMessage(),
                'request' => $request->all(),
            ]);

            return response()->json([
                'error' => true,
                'code' => 500,
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function getStudentsByBranch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:branch,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        try {
            $students = DB::table('student')
                ->join('courses', 'student.student_course_id', '=', 'courses.course_id')
                ->where('student.branch_id', $data['branch_id'])
                ->select('student.*', 'courses.course_name', 'courses.short_form') 
                ->get();

            return response()->json([
                'error' => false,
                "message" => 'Provided Successfully',
                'code' => 200,
                'data' => $students,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'code' => 500,
                'message' => 'Internal server error',
                'data' => [],
            ], 500);
        }
    }

    public function updateMarksheet(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:student,student_id',
            'marks' => 'required|string', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        try {
            $student = DB::table('student')->where('student_id', $validated['student_id'])->first();

            if (!$student) {
                return response()->json([
                    'error' => true,
                    'code' => 404,
                    'message' => 'Student not found',
                ], 404);
            }


            $marks = json_decode($validated['marks'], true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json([
                    'error' => true,
                    'code' => 400,
                    'message' => 'Invalid marks data format.',
                ], 400);
            }

            $totalMarks = 0;
            $totalPossibleMarks = 0;

            foreach ($marks as $subject => $mark) {
                $totalMarks += $mark;
                $totalPossibleMarks += 100;
            }

            $percentage = ($totalMarks / $totalPossibleMarks) * 100;

            $performance = 'Failure';
            if ($percentage >= 85) {
                $performance = 'Excellent';
            } elseif ($percentage >= 60) {
                $performance = 'Very Good';
            } elseif ($percentage >= 30) {
                $performance = 'Good';
            }

            // $marksheetStage = $percentage < 30 ? 'pending' : $student->marksheet_stage; // Set to 'pending' if < 30%

            DB::table('student')
                ->where('student_id', $validated['student_id'])
                ->update([
                    'marks' => json_encode($marks), 
                    'overall_percent' => $percentage,
                    'performance' => $performance,
                    'marksheet_stage' => 'pending',

                    'updated_at' => now(),
                ]);

            $student =  DB::table('student')->where('student_id', $validated['student_id'])->first();

            return response()->json([
                'error' => false,
                'code' => 200,
                'message' => 'Student marksheet updated successfully',
                'data' => $student,
            ], 200);

        } catch (\Exception $e) {
            // Catch any other exceptions
            return response()->json([
                'error' => true,
                'message' => 'An unexpected error occurred',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateMarksWithCertification(Request $request)
    {
        // Allowed branch IDs
        $allowedBranchIds = [0, 1, 10];

        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:student,student_id',
            'branch_id' => 'required|in:' . implode(',', $allowedBranchIds),
            'certified_date' => 'required|date_format:Y-m-d',
            'marksheet_id' => 'nullable|string|unique:student,marksheet_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        try {
            // Get the student record
            $student = DB::table('student')->where('student_id', $validated['student_id'])->first();

            if (!$student) {
                return response()->json([
                    'error' => true,
                    'code' => 404,
                    'message' => 'Student not found',
                ], 404);
            }

            if ($student->marksheet_stage != 'pending' || $student->marks == null){
                return response()->json([
                    'error' => true,
                    'code' => 404,
                    'message' => 'You can not create the certificate of unmarked student',
                ], 404);
            }

            if (in_array($validated['branch_id'], $allowedBranchIds)) {
                DB::table('student')
                    ->where('student_id', $validated['student_id'])
                    ->update([
                        'certified_date' => Carbon::parse($validated['certified_date'])->format('Y-m-d'),
                        'is_certificate_approve' => true,
                        'marksheet_id' => $validated['marksheet_id'],
                        'marksheet_stage' => 'verified',
                        'updated_at' => now(),
                    ]);
                
                $student =  DB::table('student')->where('student_id', $validated['student_id'])->first();

                return response()->json([
                    'error' => false,
                    'message' => 'Student certification updated successfully',
                    'data' => $student
                ], 200);
            }

            return response()->json(['error' => true, 'message' => 'You do not have permission to update certification'], 403);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to update certification: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getNextMarksheetId(Request $request)
    {
        try {
            $lastMarksheetId = DB::table('student')
                ->orderBy('marksheet_id', 'desc')
                ->value('marksheet_id');

            if (!$lastMarksheetId) {
               return '00001';
            }

            // Extract the numeric part from the last marksheet_id
            $numericPart = (int) $lastMarksheetId;

            // Increment the numeric part
            $nextMarksheetId = str_pad($numericPart + 1, 5, '0', STR_PAD_LEFT);


            return $nextMarksheetId;
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to generate the next marksheet_id: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getCreditOfBranch(Request $request) //unused
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:branch,id',
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
            $branchCredit = DB::table('branch')
                ->where('id', $validated['branch_id'])
                ->value('credit');

            if (is_null($branchCredit)) {
                return response()->json([
                    'error' => true,
                    'message' => 'Credit not found for the specified branch.',
                ], 404);
            }

            return response()->json([
                'error' => false,
                'message' => 'Branch credit retrieved successfully.',
                'data' => [
                    'branch_id' => $validated['branch_id'],
                    'credit' => $branchCredit,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to retrieve branch credit: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function addCreditToBranch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:branch,id',
            'credit_to_add' => 'required|numeric|min:0',
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
            $branchCredit = DB::table('branch')
                ->where('id', $validated['branch_id'])
                ->value('credit');


            $newCredit = $branchCredit + $validated['credit_to_add'];

            DB::table('branch')
                ->where('id', $validated['branch_id'])
                ->update(['credit' => $newCredit]);

            return response()->json([
                'error' => false,
                'message' => 'Credit added successfully.',
                'data' => [
                    'branch_id' => $validated['branch_id'],
                    'new_credit' => $newCredit,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to add credit to branch: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getStudentDetailsByRegistrationNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'registration_number' => 'required|string',
            'dob' => 'required|date|date_format:Y-m-d',
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
            // Check if the registration number exists
            $student = DB::table('student')
                ->where('registration_number', $validated['registration_number'])
                ->leftJoin('branch', 'student.branch_id', '=', 'branch.id')
                ->leftJoin('courses', 'student.student_course_id', '=', 'courses.course_id')
                ->select(
                    'student.*',
                    'courses.course_name',
                    'courses.short_form',
                    'courses.course_duration',
                    'branch.branch_code',
                    'branch.branch_name',
                    'branch.address_line1 as branch_address_line1',
                    'branch.city as branch_city',
                    'branch.state as branch_state',
                    'branch.zip as branch_zip',
                    'branch.phone as branch_phone'
                )
                ->first();
    
            if (!$student) {
                return response()->json([
                    'error' => true,
                    'message' => 'Registration number not found. Student is not registered.',
                ], 404);
            }
    
            // Verify DOB
            if ($student->dob !== $validated['dob']) {
                return response()->json([
                    'error' => true,
                    'message' => 'Date of birth does not match the provided registration number.',
                ], 422);
            }
    
            // Mask sensitive data
            $student->student_phone = $this->maskPhoneNumber($student->student_phone);
            $student->student_email = $this->maskEmail($student->student_email);
            $student->aadhaar_number = $this->maskAadhaarNumber($student->aadhaar_number);
    
            // Return student details if both checks pass
            return response()->json([
                'error' => false,
                'message' => 'Student data retrieved successfully.',
                'data' => $student,
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to fetch student data: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    // Helper methods
    private function maskPhoneNumber($phone)
    {
        // Remove spaces and validate phone number length
        $phone = preg_replace('/\s+/', '', $phone);
    
        if (!$phone || strlen($phone) < 10) {
            return 'NO CONTACT';
        }
    
        // Extract first 3 visible digits and last 2 visible digits
        $firstThree = substr($phone, 0, 3);
        $lastTwo = substr($phone, -2);
    
        // Handle cases with prefix like +91 or 0
        if (substr($phone, 0, 1) === '+') {
            $firstThree = substr($phone, 0, 4); // Include +91
            $middleMasked = str_repeat('*', strlen($phone) - 6); // Mask middle digits
            return $firstThree . ' ' . $middleMasked . $lastTwo;
        } elseif (substr($phone, 0, 1) === '0') {
            $firstThree = substr($phone, 0, 2); // Include 0
            $middleMasked = str_repeat('*', strlen($phone) - 4); // Mask middle digits
            return $firstThree . str_repeat('*', strlen($phone) - 4) . $lastTwo;
        }
    
        // Default case for standard 10-digit numbers
        $middleMasked = str_repeat('*', strlen($phone) - 2);
        return $middleMasked . $lastTwo;
    }
    
    private function maskEmail($email)
    {
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'NO EMAIL';
        }
    
        $parts = explode('@', $email);
        $name = $parts[0];
        $domain = $parts[1];
    
        $maskedName = substr($name, 0, 1) . str_repeat('*', strlen($name) - 2) . substr($name, -1);
        return $maskedName . '@' . $domain;
    }

    private function maskAadhaarNumber($aadhaar)
    {
        if(!$aadhaar || strlen($aadhaar) !== 12) {
            return "NO AADHAAR";
        }
        return '**** **** **** ' . substr($aadhaar, -4);
    }
    
    

}
