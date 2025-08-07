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
        Schema::create('egov_orientations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('training_control_no')->nullable();
            $table->string('event_name');
            $table->string('event_type')->nullable();
            $table->string('venue');
            $table->string('participants');
            $table->string('province');
            $table->string('municipality');
            $table->enum('mode', ['Online', 'Face to Face']);
            $table->string('status');
            $table->string('no_of_attendees');
            $table->string('no_of_downloaded_and_verified');
            $table->string('male');
            $table->string('female');
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egov_orientations');
    }
};