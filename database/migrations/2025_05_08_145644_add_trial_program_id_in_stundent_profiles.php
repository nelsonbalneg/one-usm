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
        Schema::table('stundent_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('trial_program_id')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('employee_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stundent_profiles', function (Blueprint $table) {
            $table->dropColumn('trial_program_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('employee_id');
        });
    }
};
