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
        Schema::table('portal_users', function (Blueprint $table) {
            $table->enum('gender', ['M', 'F'])->nullable()->after('lastname');
            $table->unsignedBigInteger('campus_id')->nullable()->after('gender');
            $table->unsignedBigInteger('tenant_id')->nullable()->after('campus_id');

            // Optional: add indexes for faster queries
            $table->index('campus_id');
            $table->index('tenant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portal_users', function (Blueprint $table) {
           Schema::table('portal_users', function (Blueprint $table) {
            $table->dropColumn(['gender', 'campus_id', 'tenant_id']);
        });
        });
    }
};
