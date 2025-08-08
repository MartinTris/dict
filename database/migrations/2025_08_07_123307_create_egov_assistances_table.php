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
        Schema::create('egov_assistances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('province');
            $table->string('lgu');
            $table->string('name_of_requestee');
            $table->string('email_address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('system');
            $table->text('concern')->nullable();
            $table->string('received_by');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egov_assistances');
    }
};
