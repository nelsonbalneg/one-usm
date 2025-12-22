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
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('is_repeat_exam')->nullable();
            $table->string('is_paid')->nullable();
            $table->text('receipt_photo')->nullable();
            $table->string('or_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(columns: 'is_repeat_exam');
            $table->dropColumn(columns: 'is_paid');
            $table->dropColumn(columns: 'receipt_photo');
            $table->dropColumn(columns: 'or_no');
        });
    }
};
