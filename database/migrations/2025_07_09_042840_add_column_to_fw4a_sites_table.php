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
            //
            $table->string('ap_mac_address')->nullable()->after('site_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fw4a_sites', function (Blueprint $table) {
            //
            $table->dropColumn('ap_mac_address');
        });
    }
};
