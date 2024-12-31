<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('student_name');
            $table->string('registration_number')->unique();
            $table->string('student_email')->nullable();
            $table->string('student_phone');
            $table->string('student_father_name');
            $table->string('student_mother_name');
            
            // Foreign keys
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branch')->onDelete('cascade');
            
            $table->unsignedBigInteger('student_course_id');
            $table->foreign('student_course_id')->references('course_id')->on('courses')->onDelete('cascade');
            
            $table->date('dob'); // Date of birth
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip', 10)->nullable();
            $table->date('admission_date');
            $table->date('relieving_date');
            $table->boolean('is_student_active')->default(true);
            $table->string('student_photo')->nullable();
            $table->decimal('total_fees', 10, 2)->nullable();
            $table->decimal('paid_fees', 10, 2)->nullable();
            $table->decimal('due_fees', 10, 2)->nullable();
            $table->string('marksheet_id')->unique()->nullable();
            $table->text('marks')->nullable(); // JSON-like string
            $table->enum('marksheet_stage',['started','pending','verified'])->default('started');
            $table->decimal('overall_percent', 5, 2)->nullable(); // Up to 2 decimal points
            $table->enum('performance', ['Excellent', 'Very Good', 'Good', 'Failure'])->nullable();
            $table->date('certified_date')->nullable();
            $table->boolean('is_certificate_approve')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
