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
        Schema::table('branch', function (Blueprint $table) {
            $table->date('center_creation_date')->default(DB::raw('CURRENT_DATE'))->after('password');
            $table->integer('credit')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branch', function (Blueprint $table) {
            $table->dropColumn('center_creation_date');
            $table->dropColumn('credit');
        });
    }
};