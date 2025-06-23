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
        // Drop the table if it exists
        Schema::dropIfExists('bplos');
        
        // Create the table with correct schema
        Schema::create('bplos', function (Blueprint $table) {
            $table->id();
            $table->string('province');
            $table->string('municipality_city');
            $table->enum('bpco_status', ['ON GOING DATA BUILD UP', 'FOR PILOT TESTING', 'ETRACS/Others', 'OPERATIONAL', 'PENDING']);
            $table->text('remarks')->nullable();
            $table->enum('congressional_district', ['1ST DISTRICT', '2ND DISTRICT', '3RD DISTRICT', '4TH DISTRICT', '5TH DISTRICT', '6TH DISTRICT', '7TH DISTRICT', '8TH DISTRICT']);
            $table->enum('income_class', ['CITY', '1st Class', '2nd Class', '3rd Class', '4th Class', '5th Class']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bplos');
    }
};