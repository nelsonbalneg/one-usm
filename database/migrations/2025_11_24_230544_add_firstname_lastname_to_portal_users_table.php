<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('portal.portal_users', function (Blueprint $table) {
            $table->string('firstname')->nullable()->after('student_id');
            $table->string('lastname')->nullable()->after('firstname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portal.portal_users', function (Blueprint $table) {
            $table->dropColumn(['firstname', 'lastname']);
        });
    }
};
