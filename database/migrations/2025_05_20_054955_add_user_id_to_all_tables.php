<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddUserIdToAllTables extends Migration
{
    public function up()
    {
        // List all your tables that need user_id
        $tables = [
            'bplos',
            'cybersecurities',
            'ibpls',
            'pnpkis',
            'tech4eds',
            'fw4as',
            'ilcdbs',
            'sparks',
            // Add any other tables you have
        ];
        
        foreach ($tables as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'user_id')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->foreignId('user_id')->nullable()->constrained();
                });
            }
        }
        
        // Get the first user's ID
        $firstUserId = null;
        
        if (Schema::hasTable('users')) {
            $firstUserId = DB::table('users')->value('id');
        }
        
        // Assign all existing records to the first user
        if ($firstUserId) {
            foreach ($tables as $table) {
                if (Schema::hasTable($table) && Schema::hasColumn($table, 'user_id')) {
                    DB::table($table)
                        ->whereNull('user_id')
                        ->update(['user_id' => $firstUserId]);
                }
            }
        }
    }

    public function down()
    {
        // List all tables that had user_id added
        $tables = [
            'bplos',
            'cybersecurities',
            'ibpls',
            'pnpkis',
            'tech4eds',
            'fw4as',
            'ilcdbs',
            'sparks',
            // Same tables as in up()
        ];
        
        foreach ($tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'user_id')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropForeign(['user_id']);
                    $table->dropColumn('user_id');
                });
            }
        }
    }
}