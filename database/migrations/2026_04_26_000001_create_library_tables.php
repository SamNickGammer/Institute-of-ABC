<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('library_config', function (Blueprint $table) {
            $table->id();
            $table->string('config_key')->unique();
            $table->longText('config_value');
            $table->string('value_type', 20)->default('json');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('library_members', function (Blueprint $table) {
            $table->id('member_id');
            $table->string('full_name');
            $table->string('phone', 20)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by_admin_branch_id')->nullable()->constrained('branch')->nullOnDelete();
            $table->foreignId('updated_by_admin_branch_id')->nullable()->constrained('branch')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('library_bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->string('booking_group_id', 64)->index();
            $table->foreignId('member_id')->constrained('library_members', 'member_id')->cascadeOnDelete();
            $table->unsignedSmallInteger('booking_year');
            $table->unsignedTinyInteger('booking_month');
            $table->enum('status', ['confirmed', 'secured'])->default('confirmed');
            $table->string('block_code', 20);
            $table->string('seat_id', 100);
            $table->string('seat_label', 50);
            $table->text('note')->nullable();
            $table->decimal('monthly_price', 10, 2);
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_collected_by')->nullable();
            $table->text('payment_note')->nullable();
            $table->timestamp('payment_paid_at')->nullable();
            $table->foreignId('created_by_admin_branch_id')->nullable()->constrained('branch')->nullOnDelete();
            $table->foreignId('updated_by_admin_branch_id')->nullable()->constrained('branch')->nullOnDelete();
            $table->timestamps();

            $table->unique(['booking_group_id', 'booking_year', 'booking_month'], 'library_bookings_group_month_unique');
            $table->index(['booking_year', 'booking_month']);
        });

        Schema::create('library_booking_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('library_bookings', 'booking_id')->cascadeOnDelete();
            $table->unsignedSmallInteger('booking_year');
            $table->unsignedTinyInteger('booking_month');
            $table->string('seat_id', 100);
            $table->string('slot_code', 20);
            $table->timestamps();

            $table->unique(['booking_year', 'booking_month', 'seat_id', 'slot_code'], 'library_slot_seat_unique');
        });

        Schema::create('library_booking_lockers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('library_bookings', 'booking_id')->cascadeOnDelete();
            $table->unsignedSmallInteger('booking_year');
            $table->unsignedTinyInteger('booking_month');
            $table->unsignedInteger('locker_number');
            $table->timestamps();

            $table->unique(['booking_year', 'booking_month', 'locker_number'], 'library_locker_month_unique');
        });

        Schema::create('library_payment_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('library_bookings', 'booking_id')->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method', 50)->nullable();
            $table->string('collected_by')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('created_by_admin_branch_id')->nullable()->constrained('branch')->nullOnDelete();
            $table->timestamps();
        });

        DB::table('library_config')->insert([
            [
                'config_key' => 'slot_definitions',
                'config_value' => json_encode([
                    ['id' => 'A', 'label' => 'Slot A', 'time' => '6AM-10AM', 'color' => '#f59e0b'],
                    ['id' => 'B', 'label' => 'Slot B', 'time' => '10AM-2PM', 'color' => '#10b981'],
                    ['id' => 'C', 'label' => 'Slot C', 'time' => '2PM-6PM', 'color' => '#3b82f6'],
                    ['id' => 'D', 'label' => 'Slot D', 'time' => '6PM-10PM', 'color' => '#a78bfa'],
                ]),
                'value_type' => 'json',
                'description' => 'Available library slot definitions.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'config_key' => 'pricing_tiers',
                'config_value' => json_encode([
                    '1' => 300,
                    '2' => 500,
                    '3' => 800,
                    '4' => 1000,
                ]),
                'value_type' => 'json',
                'description' => 'Monthly pricing by number of selected slots.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'config_key' => 'locker_price',
                'config_value' => '300',
                'value_type' => 'number',
                'description' => 'Monthly price per locker.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'config_key' => 'locker_numbers',
                'config_value' => json_encode([1, 2, 3, 4, 5, 6]),
                'value_type' => 'json',
                'description' => 'Available locker numbers.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'config_key' => 'seat_layout',
                'config_value' => json_encode([
                    'A' => [
                        ['row' => 'A', 'seats' => range(1, 19)],
                        ['row' => 'B', 'seats' => range(0, 11)],
                        ['row' => 'C', 'seats' => range(0, 11)],
                        ['row' => 'D', 'seats' => range(1, 17)],
                        ['row' => 'E', 'seats' => range(1, 7)],
                    ],
                    'B' => [
                        ['row' => 'A', 'seats' => range(1, 16)],
                        ['row' => 'B', 'seats' => range(1, 14)],
                        ['row' => 'C', 'seats' => range(1, 15)],
                        ['row' => 'D', 'seats' => range(1, 19)],
                    ],
                ]),
                'value_type' => 'json',
                'description' => 'Library seat layout grouped by block and row.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_payment_logs');
        Schema::dropIfExists('library_booking_lockers');
        Schema::dropIfExists('library_booking_slots');
        Schema::dropIfExists('library_bookings');
        Schema::dropIfExists('library_members');
        Schema::dropIfExists('library_config');
    }
};
