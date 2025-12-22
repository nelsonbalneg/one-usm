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
        Schema::create('clearances', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->index();     // ✅ indexed
            $table->string('lastname')->nullable()->index();   // ✅ indexed
            $table->string('firstname')->nullable()->index();  // ✅ indexed
            $table->string('middlename')->nullable();
            $table->string('suffix')->nullable();
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->text('remarks')->nullable();
            $table->string('cleared_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->datetime('updated_date_time')->nullable();
            $table->datetime('settled_date')->nullable();
            $table->string('school_year')->nullable();
            $table->string('semester')->nullable();
            $table->timestamps();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearances');
    }
};
