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
        Schema::create('student_requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->integer('student_type');
            $table->boolean('goodmoral')->default(false);
            $table->boolean('card')->default(false);
            $table->boolean('psa')->default(false); // fixed typo from `boolan` to `boolean`
            $table->boolean('hdismissal')->default(false);
            $table->boolean('certificatetransfer')->default(false);
            $table->boolean('transcript')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_requirements');
    }
};
