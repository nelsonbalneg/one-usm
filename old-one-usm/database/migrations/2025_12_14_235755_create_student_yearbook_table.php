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
        Schema::create('student_yearbook', function (Blueprint $table) {
            $table->id();
            $table->string('student_id'); // same type as portal_users.student_id
            $table->text('motto')->nullable();
            $table->json('awards')->nullable();
            $table->json('hobbies')->nullable();
            $table->json('organizations')->nullable();
            $table->json('trainings')->nullable();
            $table->text('ojt_experience')->nullable();
            $table->text('memorable_experience')->nullable();
            $table->text('career_goal')->nullable();
            $table->text('favorite_quote')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('student_id')->on('portal_users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_yearbook');
    }
};
