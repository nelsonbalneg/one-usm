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
        Schema::table('rooms', function (Blueprint $table) {
            $table->date('schedule')->nullable();
            $table->string('time')->nullable();
            $table->string('proctor')->nullable();
            $table->string('administrator')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(columns: 'schedule');
            $table->dropColumn(columns: 'time');
            $table->dropColumn(columns: 'proctor');
            $table->dropColumn(columns: 'administrator');
        });
    }
};
