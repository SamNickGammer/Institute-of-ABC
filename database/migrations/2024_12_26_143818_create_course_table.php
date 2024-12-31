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
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->timestamps();
            $table->string('course_name')->unique();
            $table->string('short_form', 10)->unique();
            $table->integer('course_duration');
            $table->enum('course_status', ['active', 'inactive'])->default('active');
            $table->decimal('course_fees', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
