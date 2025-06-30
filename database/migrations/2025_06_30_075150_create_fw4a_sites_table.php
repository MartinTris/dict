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
        Schema::create('fw4a_sites', function (Blueprint $table) {
            $table->id();

            $table->string('site_code')->unique();
            $table->string('site_name');

            $table->foreignId('region_id')->constrained('regions');
            $table->foreignId('province_id')->constrained('provinces');
            $table->foreignId('district_id')->constrained('districts');
            $table->foreignId('locality_id')->constrained('localities');

            $table->enum('contract_status', ['terminated', 'active', 'for renewal']);

            $table->foreignId('contract_id')->constrained('contracts');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('contractor_id')->constrained('contractors');

            $table->string('latitude');
            $table->string('longitude');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fw4a_sites');
    }
};
