<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pnpkis', function (Blueprint $table) {
            $table->id();
            $table->date('date_conducted');
            $table->string('time_conducted'); // Changed to string type
            $table->string('organizer');
            $table->string('province');
            $table->string('municipality');
            $table->string('district');
            $table->string('activity_title');
            $table->string('type_of_activity');
            $table->string('mode_of_implementation');
            $table->string('zoom_link')->nullable();
            $table->integer('male_participants');
            $table->integer('female_participants');
            $table->integer('total_participants');
            $table->text('participant_details');
            $table->string('resource_person');
            $table->string('fb_posting')->nullable();
            $table->integer('number_of_engagement')->nullable();
            $table->text('list_of_engaged_partners');
            $table->timestamps();
        });
        
        // Add check constraint for type_of_activity to enforce validation
        DB::statement("ALTER TABLE pnpkis ADD CONSTRAINT check_type_of_activity CHECK (type_of_activity IN ('PNPKI Orientation', 'PNPKI Personnel Training', 'PNPKI User''s Training'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pnpkis');
    }
};