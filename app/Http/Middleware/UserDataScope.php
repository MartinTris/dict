<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDataScope
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Apply global query restriction at the database level
        if (Auth::check()) {
            $userId = Auth::id();
            
            // Create a database-level global scope
            DB::listen(function ($query) use ($userId) {
                // Extract table name from the query
                $sql = $query->sql;
                if (preg_match('/from\s+[`"]?(\w+)[`"]?/i', $sql, $matches)) {
                    $table = $matches[1];
                    
                    // List of tables to apply the user_id filter to
                    $userScopedTables = [
                        'bplos', 'cybersecurities', 'ibpls', 'pnpkis', 
                        'tech4eds', 'fw4as', 'ilcdbs', 'sparks'
                    ];
                    
                    // Only apply to select queries on our managed tables
                    if (in_array($table, $userScopedTables) && 
                        stripos($sql, 'select') === 0 && 
                        stripos($sql, 'where user_id') === false) {
                        
                        // Modify the query to add the user_id constraint
                        $newSql = preg_replace(
                            '/where/i', 
                            "where {$table}.user_id = {$userId} and ", 
                            $sql, 
                            1, 
                            $count
                        );
                        
                        // If no WHERE clause exists, add one
                        if ($count === 0) {
                            $newSql = $sql . " where {$table}.user_id = {$userId}";
                            $query->sql = $newSql;
                        } else {
                            $query->sql = $newSql;
                        }
                    }
                }
            });
        }
        
        return $next($request);
    }
}