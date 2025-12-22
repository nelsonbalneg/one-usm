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
        Schema::create('booklet_numbers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('cee_term_id');
            $table->string('bookletNo');
            $table->string('envelopeNo')->nullable();
            $table->string('app_no');
            $table->string('revision_no')->nullable();
            $table->string('added_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booklet_numbers');
    }
};
