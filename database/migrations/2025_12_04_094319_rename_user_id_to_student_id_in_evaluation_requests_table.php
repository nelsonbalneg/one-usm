<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::table('evaluation_requests', function (Blueprint $table) {
            // Drop foreign key first (if exists)
            $table->dropForeign(['user_id']);

            // Drop the user_id column
            $table->dropColumn('user_id');

            // Add student_id column
            $table->string('student_id')->after('request_id');
        });
    }

    public function down(): void
    {
        Schema::table('evaluation_requests', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->after('request_id')->onDelete('cascade');
            $table->dropColumn('student_id');
        });
    }
};
