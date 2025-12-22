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
        Schema::table('ched_applicant_profiles', function (Blueprint $table) {
              $table->integer('cee_term')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ched_applicant_profiles', function (Blueprint $table) {
            $table->dropColumn('cee_term');
        });
    }
};
