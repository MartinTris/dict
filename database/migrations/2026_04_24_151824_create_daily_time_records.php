<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the daily_time_records table.
     */
    public function up(): void
    {
        Schema::create('daily_time_records', function (Blueprint $table) {
            $table->id();

            // Foreign key to user_employee table instead of users
            $table->foreignId('user_id')
                ->references('id')
                ->on('user_employee')
                ->cascadeOnDelete();

            // Store the logical workday as date in PH timezone context.
            $table->date('date');

            // Nullable so a record can exist with only clock_in initially.
            $table->timestamp('clock_in')->nullable();
            $table->timestamp('clock_out')->nullable();

            // Decimal hours (e.g. 8.50). nullable until clock_out exists.
            $table->decimal('total_hours', 8, 2)->nullable();

            $table->timestamps();

            // Enforce only one DTR record per user per day.
            $table->unique(['user_id', 'date']);
        });
    }

    /**
     * Drop the daily_time_records table.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_time_records');
    }
};
