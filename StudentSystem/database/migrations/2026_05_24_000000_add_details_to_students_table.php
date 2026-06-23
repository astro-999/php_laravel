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
        Schema::table('students', function (Blueprint $table) {
            $table->string('semester')->nullable()->after('address');
            $table->string('batch')->nullable()->after('semester');
            $table->string('course')->nullable()->after('batch');
            $table->string('year')->nullable()->after('course');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['semester', 'batch', 'course', 'year']);
        });
    }
};
