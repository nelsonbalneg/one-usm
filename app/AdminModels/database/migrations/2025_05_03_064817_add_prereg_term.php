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
            $table->integer('prereg_term_id')->nullable(); // add nullable if needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stundent_profiles', function (Blueprint $table) {
            $table->dropColumn('prereg_term_id');
        });
    }
};
