<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('user_employee')->cascadeOnDelete();
            $table->foreignId('leave_type_id')->constrained('leave_types')->restrictOnDelete();
            $table->date('start_date')->index();
            $table->date('end_date')->index();
            $table->unsignedInteger('number_of_days');
            $table->text('reason')->nullable();
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default('draft')->index();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();

            $table->index(['employee_id', 'leave_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};