<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    if (Schema::hasTable('evaluation_requests') &&
        Schema::hasColumn('evaluation_requests', 'user_id')) {

        Schema::table('evaluation_requests', function (Blueprint $table) {

            try {
                $table->dropForeign(['user_id']);
            } catch (\Exception $e) {
                // ignore if FK doesn't exist
            }

            $table->dropColumn('user_id');
            $table->string('student_id')->after('request_id');
        });
    }
}

    public function down(): void
    {
        Schema::table('evaluation_requests', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->after('request_id')->onDelete('cascade');
            $table->dropColumn('student_id');
        });
    }
};
