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
        Schema::create('branch', function (Blueprint $table) {
            $table->id()->primary()->unique();
            $table->timestamps();
            $table->string('phone');
            $table->string('email_id');
            $table->string('branch_code')->unique();
            $table->string('branch_name');
            $table->string('role')->default('branch');
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('city');
            $table->string('state');
            $table->integer('zip');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->boolean('active')->default(true);
            $table->longText('image')->nullable();
            $table->string('pass');
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch');
    }
};
