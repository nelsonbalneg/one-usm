<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('portal.evaluation_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_id')->unique(); // Example: 20251204-00001
            $table->foreignId('user_id')->references('id')->on('portal_users')->constrained()->onDelete('cascade');
            $table->string('status')->default('Pending'); // Pending, Approved, Rejected
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portal.evaluation_requests');
    }
};
