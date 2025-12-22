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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('cee_session_id');
            $table->integer('user_id');
            $table->string('campus_id');
            $table->string('app_no');
            $table->string('firstpriorty');
            $table->string('firstpriortymajor')->nullable();
            $table->string('secondpriorty')->nullable();
            $table->string('secondpriortymajor')->nullable();
            $table->string('thirdpriorty')->nullable();
            $table->string('thirdpriortymajor')->nullable();
            $table->string('exam_session');
            $table->integer('room');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
