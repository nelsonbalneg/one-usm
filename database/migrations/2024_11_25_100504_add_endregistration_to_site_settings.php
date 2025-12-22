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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dateTime(column: 'endregistration')->nullable();
            $table->string(column: 'site_name')->nullable();
            $table->string(column: 'logo_dark')->nullable();
            $table->string(column: 'logo')->nullable();
            $table->string(column: 'favicon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(columns: 'endregistration');
            $table->dropColumn(columns: 'site_name');
            $table->dropColumn(columns: 'logo_dark');
            $table->dropColumn(columns: 'favicon');
        });
    }
};
