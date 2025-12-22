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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dateTime(column: 'start_enrollment')->nullable();
            $table->dateTime(column: 'end_enrollment')->nullable();
            $table->text(column: 'enrollment_announcement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(columns: 'start_enrollment');
            $table->dropColumn(columns: 'end_enrollment');
            $table->dropColumn(columns: 'site_name');
            $table->dropColumn(columns: 'enrollment_anouncement');
        });
    }
};
