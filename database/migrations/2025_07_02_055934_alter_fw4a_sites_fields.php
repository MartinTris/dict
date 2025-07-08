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
            
            $table->dropForeign(['contract_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['contractor_id']);

            $table->dropColumn(['contract_id', 'category_id', 'contractor_id']);

            $table->string('contract')->after('contract_status');
            $table->string('category')->after('contract');
            $table->string('contractor')->after('category');

            $table->string('contract_status')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fw4a_sites', function (Blueprint $table) {
            // Rollback
            $table->dropColumn(['contract', 'category', 'contractor']);

            $table->foreignId('contract_id')->constrained('contracts');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('contractor_id')->constrained('contractors');

            $table->enum('contract_status', ['terminated', 'active', 'for renewal'])->change();
        });
    }
};
