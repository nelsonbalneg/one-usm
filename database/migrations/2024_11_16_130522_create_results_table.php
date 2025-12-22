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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('app_no');
            $table->integer('cee_exam_session');
            $table->string('fullname');
            $table->decimal('science', 10, 3)->nullable();
            $table->decimal('math', 10, 3)->nullable();
            $table->decimal('english', 10, 3)->nullable();
            $table->decimal('verbal', 10, 3)->nullable();
            $table->decimal('abstract', 10, 3)->nullable();
            $table->decimal('csa', 10, 3)->nullable();
            $table->string('status');
            $table->string('ispending_edit')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
