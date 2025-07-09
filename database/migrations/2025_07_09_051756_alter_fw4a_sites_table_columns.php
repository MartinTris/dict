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
        Schema::table('fw4a_sites', function (Blueprint $table) {
            $table->string(column: 'contract_status')->nullable()->change();
            $table->string(column: 'contract')->nullable()->change();
            $table->string(column: 'category')->nullable()->change();
            $table->string(column: 'contractor')->nullable()->change();
            $table->string(column: 'latitude')->nullable()->change();
            $table->string(column: 'longitude')->nullable()->change();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fw4a_sites', function (Blueprint $table) {
            //
            $table->string(column: 'contract_status')->nullable(false)->change();
            $table->string(column: 'contract')->nullable(false)->change();
            $table->string(column: 'category')->nullable(false)->change();
            $table->string(column: 'contractor')->nullable(false)->change();
            $table->string(column: 'latitude')->nullable(false)->change();
            $table->string(column: 'longitude')->nullable(false)->change();
        });
    }
};
