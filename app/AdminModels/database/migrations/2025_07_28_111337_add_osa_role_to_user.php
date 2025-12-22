<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Find and drop existing check constraint
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

        if ($constraint && isset($constraint->constraint_name)) {
            DB::statement("ALTER TABLE users DROP CONSTRAINT {$constraint->constraint_name}");
        }

        // Add updated constraint including 'aro'
        DB::statement("
            ALTER TABLE users
            ADD CONSTRAINT CK_users_role
            CHECK (role IN ('admin', 'utdc', 'student', 'pao', 'aro', 'dean', 'osa'))
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users DROP CONSTRAINT CK_users_role");

        // Revert to previous constraint without 'aro'
        DB::statement("
            ALTER TABLE users
            ADD CONSTRAINT CK_users_role
            CHECK (role IN ('admin', 'utdc', 'student', 'pao', 'aro', 'dean'))
        ");
    }
};
