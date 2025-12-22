<?php

use Illuminate\Support\Facades\DB;
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
        // Step 1: Find the existing check constraint name on the "role" column
        $constraint = DB::selectOne("
            SELECT con.name AS constraint_name
            FROM sys.check_constraints con
            JOIN sys.columns col 
                ON col.object_id = con.parent_object_id 
                AND col.column_id = con.parent_column_id
            JOIN sys.tables tab 
                ON tab.object_id = con.parent_object_id
            WHERE tab.name = 'users' AND col.name = 'role'
        ");

        // Step 2: Drop the existing constraint if found
        if ($constraint && isset($constraint->constraint_name)) {
            DB::statement("ALTER TABLE users DROP CONSTRAINT {$constraint->constraint_name}");
        }

        // Step 3: Add new constraint including 'pao'
        DB::statement("
            ALTER TABLE users 
            ADD CONSTRAINT CK_users_role 
            CHECK (role IN ('admin', 'utdc', 'student', 'pao'))
        ");
    }

    public function down(): void
    {
        // Drop the new constraint
        DB::statement("ALTER TABLE users DROP CONSTRAINT CK_users_role");

        // Re-add original constraint without 'pao'
        DB::statement("
            ALTER TABLE users 
            ADD CONSTRAINT CK_users_role 
            CHECK (role IN ('admin', 'utdc', 'student'))
        ");
    }
};
