<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTech4edsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tech4eds', function (Blueprint $table) {
            $table->id();
            $table->string('congressional_district');
            $table->string('municipality');
            $table->string('specific_center_location');
            $table->string('center_name');
            $table->enum('center_model', ['FITS', 'LGU', 'LIBRARY', 'Negosyo Center', 'NGA', 'Private', 'Provincial Training Center', 'RIS', 'School', 'Mobile', 'BJMP']);
            $table->string('cm_name');
            $table->string('cm_email');
            $table->string('cm_mobile');
            $table->enum('cm_sex', ['Male', 'Female', 'N/A']);
            $table->date('date_of_launching');
            $table->enum('operational', ['Yes', 'No', 'Unverified']);
            $table->enum('with_donation', ['Yes', 'No', 'Unverified']);
            $table->string('type_of_donation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tech4eds');
    }
}