// database/migrations/xxxx_xx_xx_create_cybersecurities_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCybersecuritiesTable extends Migration
{
    public function up()
    {
        Schema::create('cybersecurities', function (Blueprint $table) {
            $table->id();
            $table->date('date_conducted');
            $table->string('time_conducted');
            $table->string('organizer');
            $table->string('province');
            $table->string('activity_title');
            $table->enum('type_of_activity', ['Cyber Advocacies', 'CERT Trainings']);
            $table->string('mode_of_implementation');
            $table->string('zoom_link')->nullable();
            $table->integer('male_participants');
            $table->integer('female_participants');
            $table->integer('total_participants')->virtualAs('male_participants + female_participants');
            $table->text('participant_details')->nullable();
            $table->string('resource_person');
            $table->string('fb_posting')->nullable();
            $table->integer('number_of_engagement')->nullable();
            $table->text('list_of_engaged_partners')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cybersecurities');
    }
}