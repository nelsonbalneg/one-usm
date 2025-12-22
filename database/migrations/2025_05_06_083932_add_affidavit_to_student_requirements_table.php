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
        Schema::table('student_requirements', function (Blueprint $table) {
            $table->boolean('affidavit')->default(false)->after('transcript');
        });
    }

    public function down(): void
    {
        Schema::table('student_requirements', function (Blueprint $table) {
            $table->dropColumn('affidavit');
        });
    }
};
