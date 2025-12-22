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
        Schema::create('scanlogs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('event');
            $table->string('userid');
            $table->text('details'); // Use text for potentially long details
            $table->date('date_capture');
            $table->string('employeeid');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scanlogs');
    }
};
