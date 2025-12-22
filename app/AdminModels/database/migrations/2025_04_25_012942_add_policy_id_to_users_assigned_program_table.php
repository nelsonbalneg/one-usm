<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users_assigned_program', function (Blueprint $table) {
            $table->unsignedBigInteger('policyId')->after('major_disc_id')->nullable(); // add nullable if needed
        });
    }

    public function down(): void
    {
        Schema::table('users_assigned_program', function (Blueprint $table) {
            $table->dropColumn('policyId');
        });
    }
};
