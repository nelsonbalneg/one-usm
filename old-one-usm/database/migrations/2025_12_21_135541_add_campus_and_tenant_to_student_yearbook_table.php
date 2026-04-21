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
        Schema::table('student_yearbook', function (Blueprint $table) {
            $table->unsignedBigInteger('campus_id')->after('linkedin');
            $table->unsignedBigInteger('tenant_id')->after('campus_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_yearbook', function (Blueprint $table) {
            $table->dropColumn(['campus_id', 'tenant_id']);
        });
    }
};
