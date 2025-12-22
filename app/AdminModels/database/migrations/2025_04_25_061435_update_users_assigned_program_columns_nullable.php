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
        Schema::table('users_assigned_program', function (Blueprint $table) {
            // Make the columns nullable
            $table->unsignedBigInteger('campus_id')->nullable()->change();
            $table->unsignedBigInteger('college_id')->nullable()->change();
            $table->unsignedBigInteger('program_id')->nullable()->change();
            $table->unsignedBigInteger('major_disc_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_assigned_program', function (Blueprint $table) {
            // Revert the columns to not nullable if necessary
            $table->unsignedBigInteger('campus_id')->nullable(false)->change();
            $table->unsignedBigInteger('college_id')->nullable(false)->change();
            $table->unsignedBigInteger('program_id')->nullable(false)->change();
            $table->unsignedBigInteger('major_disc_id')->nullable(false)->change();
        });
    }
};
