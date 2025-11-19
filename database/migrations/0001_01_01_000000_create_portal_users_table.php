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
        Schema::create('portal_users', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('email')->unique();
            $table->boolean('isemailverified')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->text('photo')->nullable();
            $table->enum('role', ['admin', 'student', 'osa', 'aro', 'dean', 'vpaa', 'parent'])->default('student');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->text('remarks')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->index('created_at'); // For sorting
            $table->index('status');     // For filtering on status
            $table->index('role');       // For filtering by role
            $table->index('email');      // Already unique, but indexing helps in lookups
        });

        // Schema::create('password_reset_tokens', function (Blueprint $table) {
        //     $table->string('email')->primary();
        //     $table->string('token');
        //     $table->timestamp('created_at')->nullable();
        // });

        // Schema::create('sessions', function (Blueprint $table) {
        //     $table->string('id')->primary();
        //     $table->foreignId('user_id')->nullable()->index();
        //     $table->string('ip_address', 45)->nullable();
        //     $table->text('user_agent')->nullable();
        //     $table->longText('payload');
        //     $table->integer('last_activity')->index();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portal_users');
        // Schema::dropIfExists('password_reset_tokens');
        // Schema::dropIfExists('sessions');
    }
};
