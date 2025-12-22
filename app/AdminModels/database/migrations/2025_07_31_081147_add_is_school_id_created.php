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
        Schema::table('stundent_profiles', function (Blueprint $table) {
            $table->integer('is_school_id_created')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stundent_profiles', function (Blueprint $table) {
            $table->dropColumn('is_school_id_created');
        });
    }
};
